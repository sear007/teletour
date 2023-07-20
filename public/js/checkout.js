(function($){
    'use strict'
    

window.getNumberOfStay = function (checkIn, CheckOut) {
    const date1 = new Date(checkIn);
    const date2 = new Date(CheckOut);
    const timeDiff = Math.abs(date2.getTime() - date1.getTime());
    const totalDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    return totalDays;
}

window.calculation = function () {
    const currency = '$ ';
    const roomPrice = $('#roomPrice').val() || 0;
    const roomQuantity = $('#roomQuantity').val() || 0;
    const checkInDate = $("#check_in_date").val() || 0;
    const checkOutDate = $("#check_out_date").val() || 0;
    const numberOfStay = getNumberOfStay(checkInDate, checkOutDate);
    const price = (roomPrice * numberOfStay) * roomQuantity;
    $("#ShowRoomPrice").text(currency + parseInt(roomPrice).toFixed(2));
    $("#ShowRoomQuantity").text(roomQuantity.toString().padStart(2, '0'));
    $("#ShowNumberOfStay").text(numberOfStay.toString().padStart(2, '0'));
    $("#numberOfStay").val(numberOfStay);
    $("#ShowPrice").text(currency + price.toFixed(2));
    localStorage.setItem('checkoutInDate', checkInDate);
    localStorage.setItem('checkoutOutDate', checkOutDate);
}

window.handleSubmitCheckOut = function () {
    window.addEventListener('load', function () {
        let startDate = localStorage.getItem('checkoutInDate');
        let endDate = localStorage.getItem('checkoutOutDate');
        let guestsInput = localStorage.getItem('guests-input');
        if(guestsInput) {
            $("#guest_number").val(guestsInput);
        }
        let today = new Date();
        let tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);
        
        if(startDate && endDate) {
            const startDateObj = new Date(startDate);
            const endDateObj = new Date(endDate);
            if (endDateObj > startDateObj) {
                today = new Date(startDate);
                tomorrow = new Date(endDate);
            }
        }
        $('#check_in_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: today,
            "autoclose": true,
        }).datepicker("setDate", today)
            .on('changeDate', calculation);
        $('#check_out_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: tomorrow,
            "autoclose": true,
        })
            .datepicker("setDate", tomorrow)
            .on('changeDate', calculation);
        
        calculation();
        const forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('change', calculation);
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                event.stopPropagation();
                if (form.checkValidity() === false) {
                    form.classList.add('was-validated');
                }
                if (form.checkValidity() === true) {
                    event.preventDefault();
                    const formData = $(this).serializeArray();
                    const data = formData.reduce((object, item) => {
                        object[item.name] = item.value;
                        return object;
                    }, {});
                    $('.card-loading-overlay').addClass('d-block');
                    ajax('/checkout', { method: 'POST', data }).then(({ success, data }) => {
                        if (success) {
                            const currentUrl = window.location.href;
                            const newUrl = `${currentUrl}&tran_id=${data}`;
                            window.location.href = newUrl;
                        } else {
                            $('.card-loading-overlay').removeClass('d-block');
                            alert('Something went wrong.');
                        }
                    }).catch((error) => {
                        console.log(error);
                        $('.card-loading-overlay').removeClass('d-block');
                        alert('Something went wrong.');
                    })
                }
            }, false);
        });
    }, false);
};

window.handleAbaForm = function () {
    const urlParams = new URLSearchParams(window.location.search);
    const tran_id = urlParams.get('tran_id');
    const payment = {
        'cards':'Credit/Debit Card',
        'abapay_khqr':'ABA KHQR',
    }
    if (tran_id) {
        ajax(`/checkout/payment/${tran_id}`)
            .then((data) => {
                const { hashData, hash } = data;
                const form = $('#aba_merchant_request');
                Object.keys(hashData).map((name) => form.append((`<input type='hidden' name='${name}' value='${hashData[name]}' />`)));
                form.append((`<input type='hidden' name='hash' value='${hash}' />`));
                $("#invoice_name").text(data.name);
                $("#invoice_email").text(data.email);
                $("#invoice_hotel").text(data.branch.name);
                $("#invoice_room").text(data.room_type.name);
                $("#invoice_date_from").text(data.date_from);
                $("#invoice_date_to").text(data.date_to);
                $("#invoice_payment_option").text(payment[data.payment_option]);
                $("#invoice_price").text('$ ' + parseInt(data.price).toFixed(2));
                $("#invoice_req_time").val(data.req_time);
                $("#invoice_tran_id").val(data.tran_id);
                localStorage.setItem('hashData', JSON.stringify(hashData));
            })
            .catch(console.log)
    }
}

window.handlePaymentStatus = function () {
    let notApproved = true;
    const getStatus = () => {
        setTimeout(() => {
            const tran_id = $("#invoice_tran_id").val();
            const req_time = $("#invoice_req_time").val();
                ajax(`/checkout/payment/status`, {
                    method: 'post',
                    data: { tran_id, req_time }
                })
                .then((res) => {
                    if (res.description === 'approved') {
                        handleSendReceipt(tran_id);
                        var url = window.location.href + '&status=approved';
                        window.location.href = url;
                    } else {
                        getStatus();
                    }
                })
                .catch(console.log)
        }, 5000)
    };
    getStatus();
}

window.handleSendReceipt = function(tran_id){
    ajax(`/checkout/payment/receipt/${tran_id}`, { method: 'post' });
}

window.handleStatusApprovedScreen = function(){
    const hashData = localStorage.getItem('hashData');
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    if(hashData && status === 'approved'){
        const { tran_id, req_time } = JSON.parse(hashData);
        ajax(`/checkout/payment/status`, {
            method: 'post',
            data: { tran_id, req_time }
        })
        .then(({ payment_status }) => {
            if(payment_status === "APPROVED"){
                // Send Email
                console.log('Sending email');
            } else {
                $('.completed-animation').empty();
                $('.completed-animation').html(`
                <div class='alert alert-danger'>
                    <strong>Ooop!</strong><span class='ml-2'>We are sorry, something went wrong!</span>
                    <h5 class='small'>Please contact us.</h5>
                </div>
                `);
            }
        })
        .catch(console.log)
    }
}


function getHeaders({ headers = {} }) {
    return {
        ...headers,
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
}

function getProps(props = {}) {
    return {
        method: 'GET',
        responseType: 'json',
        ...props,
    };
}

function ajax(url, pProps = {}) {
    const props = getProps({
        ...pProps,
        url,
        headers: getHeaders(pProps),
    });

    return axios(props).then(({ data }) => data);
}
})(jQuery);

handleSubmitCheckOut();
handleStatusApprovedScreen();
const button = $('#checkout_button');
handleAbaForm();
button.click(function() {
    AbaPayway.checkout();
    handlePaymentStatus();
});