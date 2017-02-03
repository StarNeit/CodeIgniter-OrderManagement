<!-- Page Content -->
<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?= admin_url() ?>">Home</a>
            </li>
            <li><a href="<?= admin_url("recipients") ?>">Recipients</a></li>
            <li class="active"><?= $title ?></li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->
    <!-- Page Header -->
    <div class="page-header position-relative">
        <div class="header-title">
            <h1>
                <?= $title ?>
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
                    <ul class="nav nav-tabs" id="myTab7">
                        <li>
                            <a href="<?= admin_url("recipients/details/$case->id") ?>">
                                Personal Info
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?= admin_url("recipients/visit_request/$recipient->id") ?>">
                                Visit Request
        <!--                        <span class="badge badge-success">
                                    1
                                </span>-->
                            </a>
                        </li>
                        <li class="tab-red">
                            <a href="<?=admin_url('recipients/history/'.$recipient->id)?>">
                                Visit History
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content radius-bordered">
                        <div class="tab-pane in active">

                        
                    <!--/Tab Content Ends -->
                    <br/>
                    <div class="widget">
                        <div id="message"><?=show_message()?></div>
                        <div class="widget-header bg-palegreen">
                            <i class="widget-icon fa fa-arrow-down"></i>
                            <span class="widget-caption">Visit No.02042016</span>
                            <div class="widget-buttons">
                                <a href="#" data-toggle="collapse">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div><!--Widget Buttons-->
                        </div><!--Widget Header-->
                        <?= form_open(admin_url("recipients/save_request"), 'class="care-needs-form" onsubmit="return SendForm(this)"') ?>
                        <div class="widget-body">
                            <div id="message"></div>


                            <div class="form-title">
                                Where
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameInput">Block Number:</label>
                                            <input type="text" class="form-control" name="block" value="<?= $case->block ?>"
                                                   data-bv-notempty="true"
                                                   data-bv-notempty-message="This field is required and cannot be empty." />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameInput">Street:</label>
                                            <input type="text" class="form-control" name="street" value="<?= $case->street ?>"
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
                                            <input type="text" class="form-control" name="unit" value="<?= $case->unit ?>"
                                                   data-bv-notempty="true"
                                                   data-bv-notempty-message="This field is required and cannot be empty." />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameInput">Postal Code:</label>
                                            <input type="text" class="form-control" name="postal_code" value="<?= $case->postal_code ?>"
                                                   data-bv-notempty="true"
                                                   data-bv-notempty-message="This field is required and cannot be empty." />
                                        </div>
                                        <input type="hidden" name="location_id" value="<?=$case->location_id?>"/>
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
                                                        <?= form_radio("full_care", 1, $case->full_care, 'class="colored-success"') ?>
                                                        <span class="text">Yes</span>
                                                    </label>
                                                    <label>
                                                        <?= form_radio("full_care", 0, !$case->full_care, 'class="colored-success"') ?>
                                                        <span class="text">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="regidateInput">Preferred CarePro Gender:</label>
                                            <?= form_dropdown('gender_pref', gender_options(), $case->gender_pref); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12 request">
                                        Do you have any language requests?<br/>
                                        <?php foreach (languages_array() as $language): ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="colored-blue" name="language[]" value="<?= $language ?>" <?= in_array($language, $recipient->languages) ? 'checked="checked"' : '' ?>/>
                                                    <span class="text"><?= $language ?></span> 

                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-title">
                                Skills
                            </div>

                            <div class="row">
                                <div class="col-lg-12 care-services">
                                    <div class="col-lg-12">
                                        <?php foreach ($this->common->services_and_skills() as $services): ?>

                                            <?php foreach ($services->skills as $skill): ?>
                                                <div class="checkbox skills" data-service="<?=$services->service?>">
                                                    <label>

                                                        <?= form_checkbox('skill[]', $skill->id, in_array($skill->id, $case->skills), 'class="colored-blue"'); ?>
                                                        <span class="text"> <?= $skill->skill ?></span> 
                                                    </label>
                                                </div> 
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
                                            <? foreach($case->checklist as $key => $checklist ):?>                                        
                                                <div>
                                                    <input type="text" name="item[]" value="<?= $checklist->item ?>" class="col-md-6" placeholder="Text Here"/>
                                                    <?=form_dropdown('checklist[]', $this->common->skill_optgroup(), $checklist->skill_id, 'class="selectpicker col-md-4 skilldetails"' )?>
                                                    
                                                    <? if($key>0):?>
                                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><span class="remove_icon fa fa-minus-circle RemoveRow"></span></a>
                                                    <? else: ?>
                                                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="add_icon fa fa-plus-circle"></i></a>
                                                    <? endif; ?>
                                                </div>
                                            <? endforeach; ?>
                                            <? if(count($case->checklist)==0):?>
                                                <div>
                                                    <input type="text" name="item[]" value="" class="col-md-6" placeholder="Text Here"/>
                                                    <?=form_dropdown('checklist[]', $this->common->skill_optgroup(), '', 'class="selectpicker col-md-4 skilldetails"' )?>
                                                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="add_icon fa fa-plus-circle"></i></a>
                                                </div>
                                            <? endif ;?>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- /Table Ends -->
                            <div class="form-title">
                                Special Instructions
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <textarea rows="5" cols="5" class="form-control" name="special_instructions"><?= $case->special_instructions ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= $case->id ?>" />
                            <input type="hidden"  name="recipient_id" value="<?= $recipient->id ?>" />
                        </div>

                        <div class="form-title">
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 pull-right">
                                <input class="btn btn-palegreen pull-right" type="submit" value="Save" />
                            </div>
                        </div>
                    </div><br/><br/><!--Widget Body-->
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
<script>
// JavaScript Document

var case_id = <?=$case->id?>;

$(document).ready(function(){

    //remove unticket skills
    $('.skills :checkbox:not(:checked)').each(function(index, skill){
        val = $(skill).val();
        $('.skilldetails option[value="'+val+'"]').remove();
    });

    //remove optgroups with no options
    $('.skilldetails optgroup').each(function(index, optgroup){
        if($(optgroup).find('option').length ==0){
            console.log(optgroup);
            $(optgroup).remove();
        }
    });


    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
    var select = '<select class="selectpicker col-md-4 skilldetails" name="checklist[]">'+$(".skilldetails").html()+'</select>';
    var fieldHTML = '<div><input type="text" name="item[]" value="" class="col-md-6" placeholder="Text Here"/>'+select+'<a href="javascript:void(0);" class="remove_button" title="Remove field"><span class="remove_icon fa fa-minus-circle RemoveRow"></span>'; //New input field html 
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


$('.skills').on('click', '.colored-blue',function() {
    var serviceName = $(this).closest('.skills').data('service');
    var skillvalue = $(this).closest('.skills').find('input').val();
    var skillname = $(this).closest('.skills').find('span').html();
    var mySelect = $(".skilldetails");


  if ($(this).is(':checked')) {

    var menuItem = mySelect.find("optgroup[label='"+serviceName+"']").length;
    if( menuItem > 0){
           $(".skilldetails optgroup[label='"+serviceName+"']").append('<option value="'+skillvalue+'">'+skillname+'</option>');
     } else {
            mySelect.append($('<optgroup>', { label: serviceName}));
           $(".skilldetails optgroup[label='"+serviceName+"']").append('<option value="'+skillvalue+'">'+skillname+'</option>');
        }
  }else{
    $('.skilldetails option[value="'+skillvalue+'"]').remove();

    if ($(".skilldetails optgroup[label='"+serviceName+"']").find('option').length == 0) {
        $(".skilldetails  optgroup[label='"+serviceName+"']").remove();
    }
  }
    //save changes in case_skill table
    var skill_id = $(this).val();
    var is_checked = $(this).is(':checked');
    $.post(
        admin_url + 'recipients/add_case_skill', 
        {case_id: case_id, skill_id: skill_id, is_checked: is_checked }, 
        function(){}
    );
});

});
</script>