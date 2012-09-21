
function mostrar_calendario_con_tiempo_para(elemento){
    $(function() {
        $( elemento ).datetimepicker({dateFormat: 'yy-mm-dd',showSecond: false,timeFormat: 'hh:mm:00',hourGrid: 4, minuteGrid: 10});
    });
}

function mostrar_calendario_para(elemento){
    $(function() {
        $( elemento ).datepicker({dateFormat: 'yy-mm-dd'});
    });
}