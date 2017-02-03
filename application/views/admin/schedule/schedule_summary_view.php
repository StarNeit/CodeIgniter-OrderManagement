<div class="page-content">

	<? $this->load->view("admin/carepro/carepro_breadcrumbs");?>

	<div class="page-body">
		<!-- Tabs -->

		<div class="tabbable2">

			<div class="tab-content radius-bordered">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="event">
  <div class="modal-dialog">
    <div class="modal-content" id="list">
           
    </div>
  </div>
</div>



<link href='assets/css/fullcalendar.css' rel='stylesheet'/>

<script src="assets/js/moment.min.js"></script>
<script src="assets/js/moment-with-locales.js"></script>
<script src="assets/js/moment-timezone.js"></script>
<script src="assets/js/fullcalendar.js"></script>
<script type="text/javascript">
	
var calendar = null;


jQuery(document).ready(function($)
{   
    // Init Calendar
    calendar = $('#calendar').fullCalendar({
        defaultView: 'month',
        timezone: 'local',
        editable: false,
        header: {
            left: '',
            center: 'prev, title, next',
            right: 'month'
        },
        eventLimit: true,
        eventSources: [          
            {
                url: admin_url + 'schedule/availability_json',
                editable: false,
            },
            {
                url: admin_url + 'schedule/visits_json',
                editable: false,
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
        selectable: false,
      
        eventClick: function(ev, jsEvent, view) {
            ShowSchedule(ev);          
        },
    });
});


	function ShowSchedule(ev)
	{          
        url = admin_url+'schedule/day_availablity?date='+ev.start.format();
        if(ev.status)
        {
            url = admin_url + 'schedule/visit_details?date=' + ev.start.format()
        }

        $("#list")
            .html('<img src="'+base_url+'assets/admin/img/loading.gif" /> Loading')
            .load(url);
        $("#event").modal();
	  
	}



</script>