document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        height: 550,
        default: true,
        // Setting plugins
        plugins: [ 'dayGrid', 'interaction', 'timeGrid', 'list', 'bootstrap' ],
        //defaultDate: new Date(2019,8,1),
        //defaultView: 'timeGridDay',
        hiddenDays: [ 0 ],
        businessHours: [ // specify an array instead
            {
              daysOfWeek: [ 1, 2, 3, 4 ,5], // Monday, Tuesday, Wednesday
              startTime: '08:00', // 8am
              endTime: '18:00' // 6pm
            },
            {
              daysOfWeek: [ 6, ], // Thursday, Friday
              startTime: '09:00', // 10am
              endTime: '13:00' // 4pm
            }
        ],
        
        // Setting header
        header: {
            left: 'addNewCita',
            center: 'title',
            right: 'dayGridMonth,listWeek',
            //right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
        },

        // Setting footer
        footer: {
            left: '',
            center: '',
            right: 'prev,next'
        },

        // Setting bootstrap themes
        themeSystem: 'standard',

        // Getting events from server
        events: url_show,

        // Setting buttons texts
        buttonText: {
            //today:    'Hoy',
            month:    'Mes',
            //week:     'Semana',
            //day:      'Dia',
            list:     'Lista'
        },

        // Setting custom buttons
        customButtons: {

            // Creating new button
            addNewCita: {

                text: 'Cita',
                click: function() {
                    // Clean form fields
                    cleanForm();

                    // Enable star date field
                    $('#start_date').prop('disabled', false);

                    // Setting date and time
                    var date = new Date();
                    var year = date.getFullYear();
                    var month = (date.getMonth()+1);
                    var day = date.getDate();
                    
                    month = (month<10)?"0"+month:month;
                    day = (day<10)?"0"+day:day;

                    $('#start_date').val(year+'-'+month+'-'+day);
                    $('#start_time').val('12:00');
                    $('#end_date').val(year+'-'+month+'-'+day);
                    $('#end_time').val('12:30');

                    // Show hide footer buttons
                    $("#confirbtnAdd").show();
                    $("#btnAdd").hide();
                    $("#btnEdit").hide();
                   

                    // Show form modal
                    $('#eventModal').modal();
                }
            }
        },

        // Config actions when clicking in a date
        dateClick: function(info) {
            // Clean form fields
            cleanForm();
            
            // Disable star date field
            $('#start_date').prop('disabled', true);

            // Setting form fields with teh selected date and time
            $('#start_date').val(info.dateStr);
            $('#start_time').val('09:00');
            $('#end_date').val(info.dateStr);
            $('#end_time').val('18:30');
            
            // Show hide footer buttons
            $("#confirbtnAdd").show();
            $("#btnAdd").hide();
			$("#btnEdit").hide();

			
            // Show form modal
			$('#eventModal').modal();
			
            //calendar.addEvent({ title: "Evento X", date:info.dateStr });
        },

        // Config actions when clicking in an event
        
        eventClick: function(info) {
            if (info.event.extendedProps.user === user) {
                
            // Enable star date field
            $('#start_date').prop('disabled', false);

            // Getting start date and time
			start_month = (info.event.start.getMonth()+1);
			start_day = info.event.start.getDate();
			start_year = info.event.start.getFullYear();
			start_hours = info.event.start.getHours();
			start_minutes = info.event.start.getMinutes();
            
            //09-08-07 poner 0  antes de 10
			start_month = (start_month<10)?"0"+start_month:start_month;
			start_day = (start_day<10)?"0"+start_day:start_day;
			start_hours = (start_hours<10)?"0"+start_hours:start_hours;
			start_minutes = (start_minutes<10)?"0"+start_minutes:start_minutes;
            
            // Getting end date and time
			end_month = (info.event.end.getMonth()+1);
			end_day = info.event.end.getDate();
			end_year = info.event.end.getFullYear();
			end_hours = info.event.end.getHours();
			end_minutes = info.event.end.getMinutes();

			end_month = (end_month<10)?"0"+end_month:end_month;
			end_day = (end_day<10)?"0"+end_day:end_day;
			end_hours = (end_hours<10)?"0"+end_hours:end_hours;
            end_minutes = (end_minutes<10)?"0"+end_minutes:end_minutes;
            
            // setting date and time
			$('#id').val(info.event.id),
            $('#title').html(info.event.title),            
            $('#start_date').val(start_year+"-"+start_month+"-"+start_day),
            $('#start_time').val(start_hours+":"+start_minutes),
            //$('#end_date').val(end_year+"-"+end_month+"-"+end_day),
            //$('#end_time').val(end_hours+":"+end_minutes),
            $('#color').val(info.event.backgroundColor),
            $('#description').html(info.event.extendedProps.description),

            // Show hide footer buttons
            $("#btnAdd").hide();
            $("#confirbtnAdd").hide();
            if (info.event.extendedProps.user === user) {
                $("#btnEdit").show();
              
            }else{
                $("#btnEdit").hide();
                $("#btnDelete").hide();
            }

            // Show form modal
            $('#eventModal').modal();
        }

    }
});

    // Setting calendar language
    calendar.setOption('locale', 'Es');

    // Rendering calendar
    calendar.render();

    // Config add actions
    $('#btnAdd').click(function() {
        eventObj = getFormEventData("POST");
        sendInfoEvent('', eventObj);
	})
    
    // Config edit actions
	$('#btnEdit').click(function() {
        eventObj = getFormEventData("PATCH");
        sendInfoEvent('/'+$('#id').val(), eventObj);
    })

   

    // Getting data from form event modal
    //recolectar datos del formulario
    function getFormEventData(method) {

        // Validate date and time
        if (validateDate()) {
            // Creating event data object
            //nuevo evento o cita 
            newEventObj = {
                
                //title: $('#title').val(),
                start: $('#start_date').val()+" "+$('#start_time').val(),
                //end: $('#end_date').val()+" "+$('#end_time').val(),
                color: $('#color').val(),
                textColor: '#ffffff',
                //description: $('#description').val(),
                '_token': $("meta[name='csrf-token']").attr("content"),
                '_method': method
            }

            return newEventObj;            
        } else {
            return
        }
    }

    // Sendind event data object to the action
    function sendInfoEvent(action,eventObj) {
        $.ajax(
            {
                type: "POST",
                url: url_+action,
                data: eventObj,
                success: function(msg){
					$('#eventModal').modal('toggle');
                    calendar.refetchEvents();
                    swal({
                        title: "Cita generada con exito",
                        text: "Para confirmar su cita porfavor llamar al laboratorio clinico",
                        type: "success",
                        confirmButtonColor: 'blue',
                        confirmButtonText: "Aceptar",
                      });
				},
                error: function(error){
                    swal({
                        title: "Ocurrio un problema!",
                        text: "Por favor intente de nuevo, verifique la fecha y hora.",
                        type: "error",
                        confirmButtonColor: 'blue',
                        confirmButtonText: "Aceptar",
                      });
                    console.log(error);
                }
            }
        );
    }

    // Validate date and time    
    function validateDate(){
        var fecha_actual = ((new Date().getMonth())<10)?(new Date()).getFullYear()+'-0'+((new Date()).getMonth()+1)+'-'+(new Date()).getDate():(new Date()).getFullYear()+'-'+((new Date()).getMonth()+1)+'-'+(new Date()).getDate();
        if (($('#start_date').val() >= fecha_actual) ){
            return true;
        }
        return false;
        

    }
    
    // Clean form fields
	function cleanForm() {
		$('#id').val(""),
		$('#title').html(""),
		$('#description').html(""),
		$('#color').val(""),
		$('#start_date').val(""),
        $('#start_time').val(""),
        $('#end_date').val(""),
		$('#end_time').val("")
	}
});