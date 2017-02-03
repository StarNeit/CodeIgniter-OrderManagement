

var calendar = null;

jQuery(document).ready(function($)
{   
    // Init Calendar
    calendar = $('#calendar').fullCalendar({
        defaultView: 'month',
        timezone: 'none',
        editable: true,
        header: {
            left: '',
            center: 'prev,title,next',
            right: 'month,agendaWeek'
        },
        eventLimit: true, // allow "more" link when too many events
        eventSources: [
            {
                url: index_url + 'carepro/calendar/schedule',
                editable: true,
            },
           {
                url: index_url + 'carepro/calendar/visits',               
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
        selectable: true,
        //selectHelper: true,       
        select: function(start, end) {

                            
            /*if(timezone == null){
                return B.Alert('Please set your timezone');
            }*/

            if(start < new moment()){
                return B.Alert('You cannot schedule an appointment in the past.');
            }
            
            allDay = start.hour()==0 && start.minute()==0 && start.second()==0;
            ev = {
                    id: 0,
                    title: 'Available',
                    start: start,
                    end: end,
                    allDay: allDay,                      
                }       
            
            SaveEvent(ev);  
        },
        eventClick: function(ev, jsEvent, view) {
            ShowEvent(ev);          
        },
        eventDrop: function(ev, delta, revertFunc) {                
            if(ev.start > new moment()){
                SaveEvent(ev);                  
            }
            else{
                revertFunc();
            }
        },
        eventResize: function(ev, delta, revertFunc) {
            SaveEvent(ev);
        },      
        viewRender: function(view, element) { 
            if(view.name == 'agendaWeek'){
                $("#apply_week").show();
                $("#week_start").val(view.intervalStart.format("YYYY-MM-DD"));
                $("#week_end").val(view.intervalEnd.format("YYYY-MM-DD"));
            } 
            else{
                $("#apply_week").hide();    
            }
        }
    });     

    $(".calendar-view .weekly").click(function(){
        calendar.fullCalendar( 'changeView', 'agendaWeek' );
        $(".calendar-view li").removeClass("active");
        $(this).addClass("active");

    });
    $(".calendar-view .monthly").click(function(){
        calendar.fullCalendar( 'changeView', 'month' );
        $(".calendar-view li").removeClass("active");
        $(this).addClass("active");
    });

    $("thead .fc-today").wrapInner("<b></b>");

});

function ShowEvent(ev)
{
   if(ev.status){
     return ShowVisits(ev);
   }

    //set start-end information
    interval =  ev.start.format("dddd, D MMMM  YYYY");
    interval += "<br/> From "+ ev.start.format("h:mmA") + " to " + ev.end.format("h:mmA");
    

    if( typeof(ev.is_future) != 'undefined' && ! ev.is_future){
        return B.Alert(interval,'Slot Information');
    }
    
    ShowEvent.ev = ev;
    $("#event").modal();
    $("#date-interval").html(interval);

    
}

function UpdateEvent(btn)
{           
    ev = ShowEvent.ev;              
    SaveEvent(ev);          
    return false;
}
var start = null;
function SaveEvent(ev)
{
    start = ev.start;
    $("#event").modal('hide');

    if( !ev.id )
    {       
        calendar.fullCalendar('renderEvent', ev, true);                     
    }
    else{
        calendar.fullCalendar('updateEvent', ev);
        calendar.fullCalendar('unselect');  
    }

                
    //prepare data for post
    data = {
        id : ev.id,
        start : ev.start.format(),
        end : ev.end.format(),
        allDay : ev.allDay,
    };
    

    $.post(
        index_url + "carepro/calendar/save_schedule", 
        data, 
        function(data)
        {       
            if(ev.id==0){
                events = calendar.fullCalendar('clientEvents', ev.id)   
                ev = events[0];
                ev.id = data.id;
                ev._id = data.id;
            }       
        }, 
        'json'
    );
    return false;

}

function RemoveEvent() 
{
    $("#event").modal('hide');
    ev = ShowEvent.ev;
    if(ev.id){
        calendar.fullCalendar( 'removeEvents', ev.id);
        $.post( index_url + "carepro/calendar/delete_schedule",{id: ev.id},function(data){},'json');
    }
}   


function ShowVisits(ev)
{     
    url = index_url + 'carepro/calendar/visit_details?date=' + ev.start.format()
   
    $("#list")
        .html('<img src="'+base_url+'assets/admin/img/loading.gif" /> Loading')
        .load(url);
    $("#visits").modal();
  
}
