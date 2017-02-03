
<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
            </li>
            <li><a href="cases_view.html">Cases</a></li>
            <li class="active">Siah Hong Siew</li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->
    <!-- Page Header -->
    <div class="page-header position-relative">
        <div class="header-title">
            <h1>
                Siah Hong Siew
            </h1>
        </div>
    </div>
    <!-- /Page Header -->
    <!-- Page Body -->
    <div class="page-body">
        <!-- Tabs -->
        <div class="row">
            <div class="col-lg-12">
                <div class="tabbable">
                    <? $this->load->view("admin/visits/visits_subtabs")?>
                <div class="tab-content radius-bordered">
                <div class="tab-pane in active">    
                    <div class="widget">
                        <div class="widget-header bg-palegreen">
                            <i class="widget-icon fa fa-arrow-down"></i>
                            <span class="widget-caption">Visit No. <?=$visit->id;?></span>
                            <div class="widget-buttons">
                                <a href="#" data-toggle="collapse">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div><!--Widget Buttons-->
                        </div><!--Widget Header--> 
                        <?= form_open(admin_url("visits/save"), 'class="care-needs-form" onsubmit="return SendForm(this)"') ?>

                        <div class="widget-body">
                            <div id="message"><?=show_message()?></div>

                            <div class="form-title">
                                Rating
                            </div>

                            <div class="row">
                                <div class="col-lg-12 visit-view-rating">
                                    <input type="hidden" class="rating" data-filled="fa fa-star"
                                           data-empty="fa fa-star-o" value="2"/>
                                </div>
                            </div>
<br/><br/>
                            <div class="form-title">
                                Review
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <textarea rows="15" cols="5" class="form-control" name="instructions"><?=$visit->instructions?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <!-- /Matching CarePro -->
                            <div class="form-title">
                        </div>
                        <input type="hidden" name="id" value="<?= $visit->id ?>" />
                        <input type="hidden" name="case_id" value="<?= $visit->case_id ?>" />
                        <div class="form-group">
                            <div class="col-lg-6 pull-right">
                                <input class="btn btn-palegreen pull-right" type="submit" value="Save" />
                            </div>
                        </div><br/><br/>
                        </div>
                    </div><!--Widget Body-->
                    <?= form_close() ?>
                </div>
            </div>
                </div>
            </div>
        </div>

    </div>
    <br/><br/>
    <!--/tabs-->
</div>

<script src="assets/js/jquery-ui.js"></script>
<script src="assets/js/jquery.cookie.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/admin/js/bootbox/bootbox.js"></script>
<script src="assets/js/bootstrap-rating.min.js"></script>
<script>
$('head').append('<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" type="text/css" />');

// JavaScript Document

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
    var select = '<select class="selectpicker col-md-4 skilldetails" name="checklist[]">'+$(".skilldetails").html()+'</select>';
    var fieldHTML = '<div><input name="field_name[]" value="" class="col-md-6" placeholder="Text Here">'+select+'<a href="javascript:void(0);" class="remove_button" title="Remove field"><span class="remove_icon fa fa-minus-circle RemoveRow"></span>'; //New input field html 
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });


      $( ".datepicker-24-hours-care[name='visit_from']" ).datepicker(
        {
          changeMonth: true,
          changeYear: true,
          dateFormat: 'dd/mm/yy',
          yearRange: "1900:2016",
          minDate: 1,
          maxDate: "+30d",
          onSelect: function(date){
            var startDate = $( "input[name='visit_from']" ).val();
            var startDateIncrease = moment(startDate , 'DD-MM-YYYY').add('days', 1);            
            var startDateIncFormated = startDateIncrease.format('DD/MM/YYYY');
            var endDate = moment(startDate , 'DD-MM-YYYY').add('days', 30);
            var endDateFormated = endDate.format('DD/MM/YYYY');
            $( ".datepicker-24-hours-care[name='visit_to']" ).datepicker( "option", "minDate", startDateIncFormated );
            $( ".datepicker-24-hours-care[name='visit_to']" ).datepicker( "option", "maxDate", endDateFormated );
            $( ".datepicker-24-hours-care[name='visit_to']" ).datepicker( "option", "disabled", false );
            } 
        }
      );
      //to-----------------------------------------------
      $( ".datepicker-24-hours-care[name='visit_to']" ).datepicker(
        {
          changeMonth: true,
          changeYear: true,
          dateFormat: 'dd/mm/yy',
          yearRange: "1900:2016",
          disabled: true
        }
      );
      $(".datepicker_one_day").datepicker(
        {
          changeMonth: true,
          changeYear: true,
          dateFormat: 'dd/mm/yy',
          yearRange: "1900:2016",
          minDate: 1,
          maxDate: "+30d"
        }
      );
});

$(document).on('click', '.fullday', function(){
    $('.fullday_yes').toggle();
    $(".repeat_block").toggle();

});
$(document).on('click', '.assign', function(e){
    e.preventDefault();
    var name = $(this).data('name');
    var carepro_id = $(this).data('id');
    var visit_id = <?= $visit->id ?>;
    bootbox.confirm("Are you sure you want assign visit to "+name+"?", function(result) {
        if(result){
           $.ajax({
            type: "POST",
            url: "<?= admin_url("visits/assign_carepro")?>",
            data:{
                visit_id: visit_id,
                carepro_id: carepro_id
            },
            success: function(data){ShowSuccess(data)},
            dataType: "json"
             });
           
        }
        
    }); 

});     
</script>