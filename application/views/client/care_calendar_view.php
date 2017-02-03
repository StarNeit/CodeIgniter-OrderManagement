<div class="event-calendar">
    <div class="container">
        <div class="calendar-hedaer">
            <div class="clearfix">
                <div class="left-h">
                    <h3>Care Calendar</h3>
                </div>
                <div class="right-h">
                    
                    <ul class="calendar-info">
                        <li class="appointment-h">Scheduled Appointment</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="care_calendar"></div>
    </div>
</div>

<div class="modal" id="event">
  <div class="modal-dialog">
    <div class="modal-content" id="list">
           
    </div>
  </div>
</div>

<script>

jQuery(document).ready(function($)
{   
    // Init Calendar
    $('#care_calendar').fullCalendar({
        defaultView: 'month',
        timezone: 'local',
        editable: false,
        header: {
            left: '',
            center: 'prev, title, next',
            right: 'month, agendaWeek'
        },
        eventLimit: true,
        eventSources: [          
            {
                url: index_url + 'client/care_calendar/visits_json',
                editable: false,
            },
            
        ],                                          
        loading: function(isLoading, view){
            if(isLoading){
                $(".fc-left").html('<img src="'+base_url+'assets/admin/img/loading.gif" /> Loading');
            }
            else{
                $(".fc-left").html('');               
            }           
        },  
        selectable: false,
      
        eventClick: function(ev, jsEvent, view) {
            ShowSchedule(ev);          
        },
    });
});


    function ShowSchedule(ev)
    {     
        url = index_url + 'client/care_calendar/visit_details?date=' + ev.start.format()
       
        $("#list")
            .html('<img src="'+base_url+'assets/admin/img/loading.gif" /> Loading')
            .load(url);
        $("#event").modal();
      
    }



</script>