function resevationpModal(){   
    $(function() {
        const $btnReserve = $('.btn-reserve');
        const $btnDetail = $('.btn-detail');
        $btnReserve.click(function(){
            const $branch_name = $(this).attr('data-branch-name');
            const $branch_id = $(this).attr('data-branch-id');
            const $room_type_id = $(this).attr('data-room-type-id');
            const $room_type_name = $(this).attr('data-room-type-name');
            const $room_price = $(this).attr('data-room-price');
            localStorage.setItem('branch_name', $branch_name);
            localStorage.setItem('branch_id', $branch_id);
            localStorage.setItem('room_type_id', $room_type_id);
            localStorage.setItem('room_type_name', $room_type_name);
            localStorage.setItem('check_in', moment().format("YYYY-MM-DD"));
            localStorage.setItem('check_out', moment().format("YYYY-MM-DD"));
            localStorage.setItem('room_price', $room_price);
            localStorage.setItem('num_rooms', 1);
            localStorage.setItem('guest_number', 1);
            $('.branch_name').text($branch_name);
            $('.room_type_name').text($room_type_name);
            $('.check_in').text(moment().format("YYYY-MM-DD"));
            $('.check_out').text(moment().format("YYYY-MM-DD"));
            $('.num_rooms').text(1);
            $('.guest_number').text(1);
            $("#modal-reservation").modal('show');
        });
        $btnDetail.click(function(){
            const $branch_name = $(this).attr('data-branch-name');
            const $branch_id = $(this).attr('data-branch-id');
            const $room_type_id = $(this).attr('data-room-type-id');
            const $room_type_name = $(this).attr('data-room-type-name');
            const $image = $(this).attr('data-room-type-feature-image');
            const $price = $(this).attr('data-price');
            const $description = $(this).attr('data-description');
            const $remark = $(this).attr('data-remark');
            const $termCondition = $(this).attr('data-term-condition');
            const $roomFacilities = $(this).attr('data-room-facilities');
            const modal = $("#modal-room-detail");
            const modalTitle = $("#modal-room-detail .modal-title");
            const cardTitle = $("#modal-room-detail .card-title");
            const cardSubTitle = $("#modal-room-detail .card-sub-title");
            const cardImg = $("#modal-room-detail .card-img-top");
            const cardDescription = $("#modal-room-detail .description");
            const cardTermCondition = $("#modal-room-detail .term_condition");
            const cardRemark = $("#modal-room-detail .remark");
            const cardRoomFacilities = $("#modal-room-detail .room_facilities");
            const btnReserve = $("#modal-room-detail .btn-reserve");
            modal.modal('show');
            modalTitle.text($branch_name);
            cardTitle.text($room_type_name);
            cardSubTitle.text(`USD ${parseInt($price).toFixed(2)} / night`);
            cardImg.attr('src', $image);
            cardDescription.text($description);
            cardTermCondition.text($termCondition);
            cardRemark.text($remark);
            cardRoomFacilities.text($roomFacilities);
            btnReserve.attr('data-branch-id', $branch_id);
            btnReserve.attr('data-branch-name', $branch_name);
            btnReserve.attr('data-room-type-id', $room_type_id);
            btnReserve.attr('data-room-type-name', $room_type_name);
            btnReserve.attr('data-room-price', $price);
        });
    });
    const step01 = document.getElementById("step-01");
    const step02 = document.getElementById("step-02");
    const step03 = document.getElementById("step-03");
    const step04 = document.getElementById("step-04");
    step01.classList.add('active');
    const handleNextStep = (step) => {
        switch (step) {
            case 2:
                step01.classList.remove('active');
                step01.classList.add('completed');
                step02.classList.add('active');
                return false;
            case 3:
                step01.classList.add('completed');
                step02.classList.remove('active');
                step02.classList.add('completed');
                step03.classList.add('active');
                return false;
            case 4:
                step01.classList.add('completed');
                step02.classList.add('completed');
                step03.classList.add('completed');
                step03.classList.remove('active');
                step04.classList.add('completed');
                return false;
        }
    }
    const handlePrevStep = (step) => {
        switch (step) {
            case 1:
                step01.classList.remove('completed');
                step01.classList.add('active');
                step02.classList.remove('active');
                return false;
            case 2:
                step03.classList.remove('active');
                step02.classList.remove('completed');
                step02.classList.add('active');
                return false;
            case 3:
                step04.classList.remove('completed');
                step03.classList.remove('completed');
                step03.classList.add('active');
                return false;
        }
    }
    document.addEventListener('alpine:init', () => {
        Alpine.data('reservation', () => ({
            step: 1,
            isLoading: false,
            paymentSucces: false,
            submit() {
                this.isLoading = true;
                setTimeout(() => {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    axios.post('/user/reservation', { 
                        branch_id: localStorage.getItem('branch_id'),
                        room_type_id: localStorage.getItem('room_type_id'),
                        date_from: localStorage.getItem('check_in'),
                        date_to: localStorage.getItem('check_out'),
                        num_rooms: localStorage.getItem('num_rooms'),
                        guest_number: localStorage.getItem('guest_number'), 
                        price: localStorage.getItem('room_price'), 
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    }).then(({ data }) => {
                        if(data.success){
                            this.isLoading = false;
                            this.step = this.step + 1;
                            this.paymentSucces = true;
                            handleNextStep(this.step);
                        } else {
                            this.isLoading = false;
                            alert('error')
                        }
                    }).catch((error) => {
                        console.log({error})
                    })
                }, 100);
            },
            nextStep() {
                if(this.step + 1 == 4 && this.paymentSucces == false) return false;
                this.step = this.step + 1;
                handleNextStep(this.step);
            },
            prevStep() {
                this.step = this.step - 1;
                handlePrevStep(this.step);
            },
            checkPrevDisable(){
                return this.step == 1 ? true : false;
            },
            checkNextDisable(){
                return this.step == 4 ? true : false;
            },
            reset(){
                this.branch_name= '';
                this.room_type_name= '';
                this.step= 1;
                this.paymentSucces = false;
                step01.classList.add('active');
                step01.classList.remove('completed');
                step02.classList.remove('completed');
                step03.classList.remove('completed');
                step04.classList.remove('completed');
                window.localStorage.setItem('branch_name', '');
                window.localStorage.setItem('branch_id', '');
                window.localStorage.setItem('room_type_id', '');
                window.localStorage.setItem('room_type_name', '');
                window.localStorage.setItem('check_in', moment().format("YYYY-MM-DD"));
                window.localStorage.setItem('check_out', moment().format("YYYY-MM-DD"));
                window.localStorage.setItem('num_rooms', 1);
                window.localStorage.setItem('guest_number', 1);
                $('.check_in').text(moment().format("YYYY-MM-DD"));
                $('.check_out').text(moment().format("YYYY-MM-DD"));
                $('.guest_number').text(1);
                $('.num_rooms').text(1);
            }
        }))
    })
}
function actions(){
    $(function() {
        var currentDate = moment().format("YYYY-MM-DD");
        $('.date').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            "alwaysShowCalendars": true,
            "minDate": currentDate,
            "maxDate": moment().add('months', 12),
            autoApply: false,
            autoUpdateInput: true
        }, function(start, end) {
            var selectedStartDate = start.format('YYYY-MM-DD'); // selected start
            var selectedEndDate = end.format('YYYY-MM-DD'); // selected end
            $checkinInput = $('#search_checkin');
            $checkoutInput = $('#search_checkout');
            $('.check_in').text(selectedStartDate);
            $('.check_out').text(selectedEndDate);
            localStorage.setItem('check_in', selectedStartDate);
            localStorage.setItem('check_out', selectedEndDate);
            $checkinInput.val(selectedStartDate);
            $checkoutInput.val(selectedEndDate);
        });
        $("#num_rooms").change(function(event){
            localStorage.setItem('num_rooms', event.target.value);
            $('.num_rooms').text(event.target.value);
        });
        $("#guest_number").change(function(event){
            localStorage.setItem('guest_number', event.target.value);
            $('.guest_number').text(event.target.value);
        });
    });
}
actions();
resevationpModal();