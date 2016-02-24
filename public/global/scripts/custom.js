$('#calendarioUI')
$("#selectConstruct").imagepicker();
$("#selectConstruct").data('picker').sync_picker_with_select();

$("#selectConstruct1").imagepicker();
$("#selectConstruct1").data('picker').sync_picker_with_select();

$('.step').stepify({
    distribution:[1,1],
	nextHooks : {
				0 : [
						function ($stepContainer){
						if($('#selectConstruct')[0].selectedIndex <= 0){
						console.log('not selected');
						return false;
						}
						else{
						    console.log('selected');
                            $("#calendarioUI").css("visibility", "visible");
                            $("#calendarioUI").css("opacity", "1");
                            return true;
						}
						}
					]
			}
});

$('.next-step').click(function(){
    $('#calendar').fullCalendar('render');
    var id_proyecto = $('#selectConstruct').val();
    $.ajax({
        type:'post',
        dataType: "json",
        data: {'_token': $('meta[name=csrf-token]').attr('content'), 'selectConstruct': id_proyecto},
        url: '/Solicitudes',
        success: function(r) {
        $('#NumeroSolicitud').val(r.id);
        }
    },"json");
});

$('.next-step').click(function(){
    if($('#selectConstruct')[0].selectedIndex <= 0) {
    $('#error-select').html('<div class="alert alert-danger"><strong>Seleccione una opción</strong>');
	$('#error-select').show();
    }
});


$('.btn-submit').click(function(){
    var idSol = $('#NumeroSolicitud').val();
    $.ajax({
        type: 'get',
        url: '/Solicitudes/' + idSol,
        success: function () {
            $('#success_pr').html('<div class="alert alert-success"><strong>Su solicitud fue enviada con éxito. Recibirá un correo con los detalles. Será redirigido en 5 segundos...</strong>')
            setTimeout(function() {
                window.location.replace('/');
            }, 5000);
        }
    });
});




$(document).ready(
    function() {
        var formatted_date = function (date) {
            var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ];
            var m = (monthNames[date.getMonth()]); // En JavaScript el mes empieza en 0.
            var d = ("0" + (date.getDate())).slice(-2); // Anteponer un cero
            var y = date.getFullYear();
            return d + ' de ' + m;
        }

        function nextweek() {
            var today = new Date();
            var nextweek = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 7);
            return nextweek;
        };


        var curr_date = nextweek();

        var dayy = curr_date.getDay();

        var diff = curr_date.getDate() - dayy + (dayy == 0 ? -6 : 1); // 0 para Domingo

        var week_start_tstmp = curr_date.setDate(diff);

        var week_start = new Date(week_start_tstmp);

        var week_start_date = formatted_date(week_start);

        var week_end = new Date(week_start_tstmp);  // first day of week

        week_end = new Date(week_end.setDate(week_end.getDate() + 6));

        var week_end_date = formatted_date(week_end);

        var WeekDate = 'Semana del ' + week_start_date + ' al ' + week_end_date;    // Rango de semana para la próxima
        /*
         var week_end_date =formatted_date(new Date()); // limit current week date range upto current day.
         */

        document.getElementById('dateWeek').innerHTML = WeekDate;
    });

$(document).ready(function()
    {
        $('#calendar').fullCalendar('incrementDate, 0, 0, 7');
    });



$(document).ready(function() {

    $("#selectElement").change(function() {
        $.getJSON("/Tipos/" + $('#selectElement').val() , function(data) {
            var $secondChoice = $("#Referencess");
            $secondChoice.empty();
            $.each(data, function(index, value) {
                $secondChoice.append('<option value="' + value.id+'">' + value.value + '</option>');
                $secondChoice.selectpicker('refresh');
            });
        });
    });

    $("#selectElement1").change(function() {
        $.getJSON("/Tipos/" + $('#selectElement1').val() , function(data) {
            var $secondChoice = $("#Referencess1");
            $secondChoice.empty();
            $.each(data, function(index, value) {
                $secondChoice.append('<option value="' + value.id+'">' + value.value + '</option>');
                $secondChoice.selectpicker('refresh');
            });
        });
    });

    var currentDate = moment().add(7, 'day');
    var Elementu;
    var Eventu;

    $('#calendar').fullCalendar('destroy'); // destroy the calendar
    $('#calendar').fullCalendar({ //re-initialize the calendar
        firstDay: 1,
        defaultView: 'basicWeek',
        height: 250,
        defaultDate: currentDate,
        editable: true,
        selectable: true,
        eventStartEditable: false,
        select: function(start, end) {
            endtime = moment(end).subtract(1, 'hour').format('dddd DD MMM');
            starttime = moment(start).add(1, 'hour').format('dddd DD MMM');
            var diaSemana = moment(start);
            $('#Addelementmodal #apptStartTime').val(moment(end).subtract(1, 'hour'));
            $('#Addelementmodal #apptEndTime').val(moment(end).add(1, 'hour'));
            $('#dayofWeek').val(moment(diaSemana).isoWeekday());
            $('#Addelementmodal').modal('show');
            console.log(moment(diaSemana).isoWeekday());
            $('#calendar').fullCalendar('unselect');
        },
        eventClick: function (evento) {
            $('#Editelementmodal').modal('show');
            Elementu = evento._id;
            Eventu = evento;
        }
    });

    $('#BotonEditar').on('click', function(e){
        e.preventDefault();
        EditarElemento();
    });

    $('#Cancelar').on('click', function(e){
        e.preventDefault();
        EditarElemento();
    });

    function EditarElemento(){
        var cantidadElem = $("#CantidadElemento1").val();
        if($('#Referencess1')[0].selectedIndex <= 0) {
            $('#ErrorRe1').html('<div class="alert alert-danger"><strong>Seleccione una referencia válida</strong>');
            $('#ErrorRe1').show();
        }
        else if (cantidadElem == NaN || cantidadElem <= 0) {
            $('#ErrorCa1').html('<div class="alert alert-danger"><strong>Introduzca una cantidad válida</strong>');
            $('#ErrorCa1').show();
        }
        else {
            $("#Editelementmodal").modal('hide');
            var Cantidad = $('#CantidadElemento1').val();
            var Elementox = $('#Referencess1 option:selected').text();
            var Elemento = $('#Referencess1').val();
            var title = Cantidad + 'm3 de ' + Elementox;
            Eventu.title = title;
            $.ajax({
                type: 'post',
                dataType: "json",
                async: false,
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    'cantidad': Cantidad,
                    'elemento': Elemento
                },
                url: '/Detalle/' + Elementu,
                success: function (r) {
                    $('#CantidadElemento1').val("");
                }
            }, "json");
            console.log(Elementu);
            $('#calendar').fullCalendar('updateEvent', Eventu);
            $('#errorRe1').hide();
            $('#Referencess').empty();
            $('#Referencess').append('<option value="base">Seleccione una referencia</option>');
            $('#Referencess, #selectElement').val("base");
            $('#Referencess, #selectElement').selectpicker('refresh');
            $('#ErrorRe1').hide();
            $('#ErrorCa1').hide();
        }
    }

    $('#DeleteButton').on('click', function(e){
        e.preventDefault();
        EliminarElemento();
    });

    function EliminarElemento(){
        $.ajax({
            type:'delete',
            dataType: "json",
            data: {'_token': $('meta[name=csrf-token]').attr('content')},
            url: '/Detalle/'+ Elementu,
            success: function(){
                console.log('deleted');
            }
        },"json");
        $('#calendar').fullCalendar('removeEvents', Elementu);
    }

    $('#VolverConstruccion').on('click', function(e){
        e.preventDefault();
        $('#SeleccionarConstruccion').modal('show');

    });

    $('#BotonEnvio').on('click', function(e){
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        EnviarSol();
    });

    function EnviarSol() {
        var cantidadElem = $("#CantidadElemento").val();
        if($('#Referencess')[0].selectedIndex <= 0) {
            $('#ErrorRe').html('<div class="alert alert-danger"><strong>Seleccione una referencia válida</strong>');
            $('#ErrorRe').show();
        }
        else if (cantidadElem == NaN || cantidadElem <= 0) {
            $('#ErrorCa').html('<div class="alert alert-danger"><strong>Introduzca una cantidad válida</strong>');
            $('#ErrorCa').show();
        }

        else {
            $("#Addelementmodal").modal('hide');
            var loadingAjax = function () {
                var over = '<div id="overlay">' +
                    '<img id="loading" src="global/img/pMtW1K.gif">' +
                    '</div>';
                $(over).appendTo('.calendar');
            };
            loadingAjax();
            var Cantidad = $('#CantidadElemento').val();
            var Elemento = $('#Referencess').val();
            var IDSolicitud = $('#NumeroSolicitud').val();
            var diasemana = $('#dayofWeek').val();
            $.ajax({
                type: 'post',
                dataType: "json",
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    'NumeroSolicitud': IDSolicitud,
                    'cantidad': Cantidad,
                    'elemento': Elemento,
                    'dia': diasemana
                },
                url: '/Detalle',
                success: function (r) {
                    $('#ElementoID').val(r.id);
                    $("#calendar").fullCalendar('renderEvent',
                        {
                            id: $('#ElementoID').val(),
                            title: +$('#CantidadElemento').val() + 'm3 de ' + $('#Referencess option:selected').text(),
                            start: new Date($('#apptStartTime').val()),
                            end: new Date($('#apptStartTime').val())
                        },
                        true);
                    console.log($('#ElementoID').val());
                    $('#CantidadElemento').val("");
                    $('#ElementoID').empty();
                    console.log($('#ElementoID').val());
                    $('#dayofWeek').empty();
                }
            }, "json");
            $('#errorRe').hide();
            $('#ErrorCa').hide();
            $('#Referencess').empty();
            $('#Referencess').append('<option value="base">Seleccione una referencia</option>');
            $('#Referencess, #selectElement').val("0");
            $('#selectElement').val("base");
            $('#Referencess, #selectElement').selectpicker('refresh');
        }
    }
    $( document ).ajaxStop(function() {
        $('#overlay').remove();
    });
});






