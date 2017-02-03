
<div class="event-calendar">
    <div class="container">
        <div class="calendar-hedaer">
            <div class="clearfix">
                <div class="left-h">
                    <h3>Care Calendar</h3>
                </div>
                <div class="right-h">
                    <ul class="calendar-view">
                        <li class="weekly">Weekly</li>
                        <li class="monthly active">Monthly</li>
                    </ul>
                    <ul class="calendar-info">
                        <li class="avail-h">Available</li>
                        <li class="appointment-h">Scheduled Appointment</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="calendar"></div>
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

<!-- Scheduled Visits Popup -->
<div class="modal" id="visits">
  <div class="modal-dialog">
    <div class="modal-content" id="list">
           
    </div>
  </div>
</div>