var urlParams = new URLSearchParams(window.location.search);

$(document).ready(function() {
    show();
    getProvinces();
    handleSelectProvince();
    searching();
    $('#guests-input').change(function(){
        localStorage.setItem('guests-input', $(this).val());
    });
});
function closeDropdown(){
    $("#__close-drop-down").css('display', 'none');
    $("#input-popular-destination__drop").css('display', 'none');
}
function showCalendar(){
    $('#input-filter-date').daterangepicker({
        locale: { format: 'YYYY-MM-DD' },
        "autoApply": true,
        "opens": "center",
        "singleDatePicker": false,
        "showDropdowns": false,
        "showWeekNumbers": false,
        "showISOWeekNumbers": true,
    }).on('apply.daterangepicker', function(ev, picker) {
        localStorage.setItem('checkoutInDate', picker.startDate.format('MM/DD/YYYY'));
        localStorage.setItem('checkoutOutDate', picker.endDate.format('MM/DD/YYYY'));
    });
}
function show(){
    if (urlParams.has('province') && urlParams.has('province_name')) {
        var provinceId = urlParams.get('province');
        var provinceName = urlParams.get('province_name');
        $('#input-popular-destination-value').val(provinceId);
        $('#input-popular-destination').val(provinceName);
    }
    if (urlParams.has('date')) {
        var date = urlParams.get('date');
        $('#input-filter-date').val(date);
    }
    if (urlParams.has('guests')) {
        var date = urlParams.get('guests');
        $('#guests-input').val(date);
    }
    $('#input-popular-destination').on('focus', function(){
        $("#input-popular-destination__drop").css('display', 'inline-table');
        $("#__close-drop-down").css('display', 'flex');
    });
    $("#__close-drop-down a").on("click", function(e){
        e.preventDefault();
        closeDropdown();
        $('#input-popular-destination').val('');
    });
    $("#input-filter-date").focus(function(){
        showCalendar();
    });
    const guestsInput = localStorage.getItem('guests-input');
    if(guestsInput) {
        $("#guests-input").val(guestsInput);
    }
}
function handleSelectProvince(){
    $(".__drop-down a").on("click", function(e){
        e.preventDefault();
        const id = $(this).attr('value');
        const text = $(this).text();
        $('#input-popular-destination').val(text);
        $('#input-popular-destination-value').val(id);
        closeDropdown();
    });
}

function selectCountry(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
}
function searching(){
    $("#input-popular-destination").keyup(function() {
        const search = $(this).val();
        getProvinces(search);
    });
}
function getProvinces(search = ''){
    $.ajax({
        type: "GET",
        url: "/ajax/provinces?search=" + search,
        beforeSend: function() {
            $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data) {
            var dropdownElement = '<p class="title">Popular Destination</p>';
            data.map(({ name, id }) => {
                dropdownElement += '<a value="'+id+'" href="#">'+name+'</a>';
            });
            $("#input-popular-destination__drop").html(dropdownElement);
            handleSelectProvince();
        }
    });
}