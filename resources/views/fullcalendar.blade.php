<!doctype html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
</head>
<body>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
               Event Calendar.
        </div>
        <div class="panel-body" >
            <div id='calendar'></div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            navLinks: true,
            editable: true,
            events: "getevent",           
            displayEventTime: false,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
        selectable: true,
        selectHelper: true,
        select: function (date) {
            var title = prompt('Event Title:');
            var description = prompt('Description:');
            if (title) {
                var date = moment(date, 'DD.MM.YYYY').format('YYYY-MM-DD');
                $.ajax({
                    url: 'createevent',
                    data: 'title=' + title +'&description=' + description + '&date=' + date +'&_token=' +"{{ csrf_token() }}",
                    type: "post",
                    success: function (data) {
                        $('#calendar').fullCalendar( 'refetchEvents' )
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            description: description,
                            date: date
                        },
                true
                        );
            }
            else{
                alert('title is required');
            }
            $('#calendar').fullCalendar( 'refetchEvents' )
        },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "delete",
                    data: "&id=" + event.id+'&_token=' +"{{ csrf_token() }}",
                    success: function (response) {
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            $('#calendar').fullCalendar( 'refetchEvents' )
                        }
                    }
                });
            }
        }
        });
    });
</script>
</html>