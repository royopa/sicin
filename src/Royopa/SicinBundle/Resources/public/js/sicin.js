$(document).ready(function() {

    $('.voltar').click(function(){
        parent.history.back();
        return false;
    });

    // get the current date
    var date = new Date();
    var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();

    $(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        beforeShowDay: $.datepicker.noWeekends,
    });

    $(".select2").select2({
        allowClear: true
    });
});