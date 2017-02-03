<div class="page-content">

	<? $this->load->view("admin/carepro/carepro_breadcrumbs");?>

	<div class="page-body">
		<!-- Tabs -->

		<div class="tabbable2">

			<? $this->load->view("admin/carepro/carepro_tabs")?>

			<div class="tab-content radius-bordered">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="event">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="panel-title">Remove Availability</h3>
        </div>        
        <div class="modal-body">
            <div class="text-center">
                <i class="glyphicon glyphicon-calendar"></i>
                <span id="date-interval"></span>
            </div>
            <br/>
            <p class="text-muted">
                <strong>Note: </strong> You can resize and drag your available slots to change time and duration
            </p>            
        </div>
        <div class="modal-footer">          
            <button type="button" class="btn btn-danger pull-left" onclick="RemoveEvent()" tabindex="-1">Remove</button>                
            <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="-1">Cancel</button>
        </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- ALERT POPUP -->
<div class="modal" id="alert-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">             
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="alert-title">Warning!</h4>
            </div>
                <div class="modal-body" id="alert-message">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>  
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ALERT POPUP -->


<link href='assets/css/fullcalendar.css' rel='stylesheet'/>

<script src="assets/js/moment.min.js"></script>
<script src="assets/js/moment-with-locales.js"></script>
<script src="assets/js/moment-timezone.js"></script>
<script src="assets/js/fullcalendar.js"></script>
<script type="text/javascript">
	
var calendar = null;
var user_id = '<?=$user->user_id?>';

jQuery(document).ready(function($)
{   
    // Init Calendar
    calendar = $('#calendar').fullCalendar({
        defaultView: 'month',
        timezone: 'none',
        editable: true,
        header: {
            left: '',
            center: 'prev, title, next',
            right: 'month,agendaWeek'
        },
        eventLimit: true,
        eventSources: [          
            {
                url: admin_url + 'carepro/schedulesjon/'+user_id,
                editable: true,
            }
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

            moment.tz.setDefault("Asia/Singapore");
            now = new moment();
            if(start < now ){
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
        eventDrop: function(ev, delta, revertFunc) 
        {     
            moment.tz.setDefault("Asia/Singapore");
           
            var now = new moment();
         
            if(ev.start > now){
                SaveEvent(ev);                  
            }
            else{
                revertFunc();
            }
        },
        eventResize: function(ev, delta, revertFunc) {
            SaveEvent(ev);
        },         

	});
});


	function ShowEvent(ev)
	{
	    if(ev.url){
	        return;
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
	        user_id: user_id,
	    };
	    

	    $.post(
	        admin_url + "carepro/save_schedule", 
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
	        $.post( admin_url + "carepro/delete_schedule",{id: ev.id},function(data){},'json');
	    }
	}   


</script>