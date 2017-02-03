
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
                            <!--i class="widget-icon fa fa-arrow-down"></i-->
                            <span class="widget-caption">Visit No. <?=$visit->id;?></span>
                            <div class="widget-buttons">
                                <!--a href="#" data-toggle="collapse">
                                    <i class="fa fa-minus"></i>
                                </a-->
                            </div><!--Widget Buttons-->
                        </div><!--Widget Header--> 
                        <?= form_open(admin_url("visits/save"), 'class="care-needs-form" onsubmit="return SendForm(this)"') ?>

                        <div class="widget-body">
                            <div id="message"><?=show_message()?></div>
                            <div class="form-title">
                                Where
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameInput">Block Number:</label>
                                            <input type="text" class="form-control" name="block" value="<?= $visit->block ?>"
                                                   data-bv-notempty="true"
                                                   data-bv-notempty-message="This field is required and cannot be empty." />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameInput">Street:</label>
                                            <input type="text" class="form-control" name="street" value="<?= $visit->street ?>"
                                                   data-bv-notempty="true"
                                                   data-bv-notempty-message="This field is required and cannot be empty." />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameInput">Unit Number:</label>
                                            <input type="text" class="form-control" name="unit" value="<?= $visit->unit ?>"
                                                   data-bv-notempty="true"
                                                   data-bv-notempty-message="This field is required and cannot be empty." />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameInput">Postal Code:</label>
                                            <input type="text" class="form-control" name="postal_code" value="<?= $visit->postal_code ?>"
                                                   data-bv-notempty="true"
                                                   data-bv-notempty-message="This field is required and cannot be empty." />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-title">
                                CarePro Preferences
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Do you require 24hr Care/Live-in care?</label><br/><br/>
                                            <div class="control-group request">
                                                <div class="radio-inline">
                                                    <label>
                                                        <?= form_radio("full_day", 1, $visit->full_day, 'class="colored-success fullday"') ?>
                                                        <span class="text">Yes</span>
                                                    </label>
                                                    <label>
                                                        <?= form_radio("full_day", 0, !$visit->full_day, 'class="colored-success fullday"') ?>
                                                        <span class="text">No</span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">    
                                    <div class="col-lg-8">
                                    <div class="schedule_block fullday_yes form-group" <?=$visit->full_day ? '' : 'style="display:none"'?>>
                                    <div class="date-choose">
                                    <div class="row">
                                        <div class="col-lg-3">
                                        <label>Date</label>
                                        <input type="text" name="visit_from" class="form-control datepicker-24-hours-care" placeholder="DD/MM/YYYY" value="<?=date('d/m/Y',strtotime($visit->visit_from))?>">
                                        </div>
                                        
                                        <div class="col-lg-3">
                                        <label>To</label>
                                        <input type="text" name="visit_to" class="form-control datepicker-24-hours-care" placeholder="DD/MM/YYYY" value="<?=date('d/m/Y',strtotime($visit->visit_to))?>">
                                        </div>
                                    </div>
                                    </div>   
                                    </div>
                                    <div class="repeat_block" <?=$visit->full_day ? 'style="display:none"' : ''?>>
                                            
                                            <div class="form-group" style="display:none"> 
                                                <p>Do you require this schedule to be repeated?</p>

                                                <div class="radio-inline">
                                                    <label>
                                                        <input type="radio" name="repeat" value="1" class="colored-success repeat" >
                                                        <span class="text">Yes</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="repeat" value="0" class="colored-success repeat" checked >
                                                        <span class="text">No</span>
                                                    </label>
                                                </div>
                                            </div>     
                                            <div class="schedule_block one_day_visit form-group">
                                                <div class="date-choose row">
                                                    <div class="col-lg-3">
                                                        <label>Date</label>
                                                        <input type="text" name="one_day_date"  placeholder="DD/MM/YYYY" class="form-control datepicker_one_day" value="<?= date('d/m/Y',strtotime($visit->visit_from))?>">
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <div class="time-range" >
                                                        <div class="col-lg-6">
                                                        <label>Start time</label>
                                                        <?=form_dropdown('one_day_start', time_options(),date('H:i:s',strtotime($visit->visit_from)), 'class="form-control"');?>
                                                        </div>
                                                        <div class="col-lg-6">
                                                        <label>To</label>
                                                        <?=form_dropdown('one_day_end', time_options(),date('H:i:s',strtotime($visit->visit_to)), 'class="form-control"');?>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <? if(count($visit->skills)>0): ?>
                            <div class="form-title">
                                Skills
                            </div>
                            <div class="row">
                                <div class="col-lg-12 care-services">
                                    <div class="col-lg-12">
                                        <?php foreach ($this->common->services_and_skills() as $services): ?>

                                            <?php foreach ($services->skills as $skill): 
                                                if(in_array($skill->id, $visit->skills)):?>
                                                <div class="checkbox skills" data-service="<?=$services->service?>">
                                                    <label>

                                                        <?= form_checkbox('skill[]', $skill->id, in_array($skill->id, $visit->skills), 'class="colored-blue" disabled readonly'); ?>
                                                        <span class="text"> <?= $skill->skill ?></span> 
                                                    </label>
                                                </div> 
                                                 <? endif; ?> 
                                            <?php endforeach; ?>

                                        <?php endforeach; ?>
                                    </div>
                                </div>    
                            </div>
                            <br/>
                            <!-- Table Starts -->
                            <div class="row ">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="well with-header">
                                        <div class="header bg-blue">
                                            Details
                                        </div>
                                        <div class="field_wrapper">
                                        <? if(count($visit->checklist)>0):?>
                                        <? foreach($visit->checklist as $key => $checklist ):?>
                                        
                                            <div>
                                                <input name="field_name_<?=$checklist->id?>" class="col-md-6" placeholder="Text Here" value="<?= $checklist->checklist ?>" >
                                                <? if($key>0):?>
                                                <a href="javascript:void(0);" class="remove_button" title="Remove field"><span class="remove_icon fa fa-minus-circle RemoveRow"></span></a>
                                                <? else: ?>
                                                <a href="javascript:void(0);" class="add_button" title="Add field"><i class="add_icon fa fa-plus-circle"></i></a>
                                                <? endif; ?>
                                            </div>
                                        <? endforeach; ?>
                                        <? else: ?>
                                            <div>
                                                <input name="field_name[]" value="" class="col-md-6" placeholder="Text Here" >
                                                <a href="javascript:void(0);" class="add_button" title="Add field"><i class="add_icon fa fa-plus-circle"></i></a>
                                            </div>
                                    <? endif ;?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <? endif;?>

                            <!-- /Table Ends -->
                            <div class="form-title">
                                Special Instructions
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <textarea rows="5" cols="5" class="form-control" name="instructions"><?=$visit->instructions?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <!-- Matching CarePro -->
                            <div class="col-lg-12 widget-tab">
                                <h6 class="row-title before-green">MATCHING CAREPRO(S)</h6>
                                <input type="text" id="skills" name="skills" value=""/>
                            </div>
                            <br/>
                            <div class="row carepro">
                                
                                <?if(count($carepros)>0):?>
                                    <? foreach ($carepros as $carepro): ?>
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="databox databox-xlg databox-halved databox-shadowed databox-vertical no-margin-bottom">
                                                <div class="databox-top bg-white padding-10">
                                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                                        <img src="<?= get_image(PHOTOS . $carepro->photo)?>" style="width:75px; height:75px;" class="image-circular bordered-3 bordered-palegreen">
                                                    </div>
                                                    <div class="col-lg-6 col-sm-8 col-xs-8 text-align-left padding-10">
                                                        <span class="databox-header carbon no-margin"><?= $carepro->first_name .' '.$carepro->last_name?></span>
                                                        <span class="databox-text lightcarbon no-margin green">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-2 margin-top-20">
                                                        <button class="btn btn-info btn-sm pull-right assign" data-name="<?= $carepro->first_name .' '.$carepro->last_name?>" data-id="<?=$carepro->id?>">Assign</button>
                                                    </div>
                                                </div>
                                                <div class="bg-white no-padding">
                                                    <div class="databox-row row-12">
                                                        <div class="databox-row row-6 no-padding">
                                                            <div class="databox-cell cell-4 no-padding text-align-center bordered-right bordered-platinum">
                                                                <span class="databox-text sonic-silver  no-margin">District</span>
                                                                <span class="databox-number lightcarbon no-margin">Punggol East</span>
                                                            </div>
                                                            <div class="databox-cell cell-4 no-padding text-align-center bordered-right bordered-platinum">
                                                                <span class="databox-text sonic-silver no-margin">Rating</span>
                                                                <span class="databox-number lightcarbon no-margin"><?=round($carepro->rating, 1)?> / 5</span>
                                                            </div>
                                                            <div class="databox-cell cell-4 no-padding text-align-center">
                                                                <span class="databox-text sonic-silver no-margin">Age</span>
                                                                <span class="databox-number lightcarbon no-margin"><?=calculate_age($carepro->dob)?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? endforeach;?>
                                <?else:?>
                                <div class="col-lg-12" style="text-align:center">No matching Carepro found!</div>
                                <?endif?>
                            </div>
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
<script>
$('head').append('<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" type="text/css" />');

// JavaScript Document

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
    var fieldHTML = '<div><input name="field_name[]" value="" class="col-md-6" placeholder="Text Here"><a href="javascript:void(0);" class="remove_button" title="Remove field"><span class="remove_icon fa fa-minus-circle RemoveRow"></span>'; //New input field html 
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
<link rel="stylesheet" href="<?= base_url("assets/admin/js/select2/select2.css")?>" type="text/css" />
<script src="<?= base_url('assets/admin/js/select2/select2.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
	

	$(function(){
	 
		$("#skills").select2({  
			width: '100%',
			multiple: true,
			minimumInputLength: 1,	
			initSelection: function(element, callback) {
				callback(<?=json_encode($skills_array)?>);
			},		
			ajax: {				
				url: admin_url+"visits/search_skill",
				dataType: 'json',				
				data: function (term, page){
					return {
						term: term,
						page: page,
						limit: 15,
					};
				},
				results: function (data, page) {  
				
					return {
						results: data,
						more: 15 == data.length
					};
				}			
			}
		});
	})
</script>