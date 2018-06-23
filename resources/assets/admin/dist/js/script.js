$(function () {
    $("#example1").DataTable();
});

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Date picker
    // $('#datepicker').datepicker({
    //     autoclose: true,
    //     format: 'dd/mm/yy'
    // });
    //DateTime picker


    //DateTime picker
    $('#datetimepicker').datetimepicker({
        locale: 'ru',
        format: 'DD/MM/YYYY HH:mm',
        sideBySide: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });


});