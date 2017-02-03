<!-- Page Content -->
    <div class="page-content">
        
        <? $this->load->view("admin/carepro/carepro_breadcrumbs");?>
        
        <!-- Page Body -->
        <div class="page-body">
            <!-- Tabs -->
           
                <? $this->load->view('admin/carepro/carepro_tabs')?>

                <div class="tab-content radius-bordered">
                    <div class="tab-pane in active">
                      

                        <?=form_open(admin_url("carepro/save_details"), 'onsubmit="return SendForm(this)" class="form-horizontal"')?>
                        
                            <?if($user->user_id):?>
                                <div class="form-title">
                                    About CarePro
                                </div>

                                <div class="profile-container">
                                    <div class="profile-header row">
                                        <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                                            <img id="user-avatar" src="<?=get_s3_file('carepro',$user->photo,$user->user_id,"avatar")?>" alt="" class="header-avatar" />
                                        </div>
                                        <div class="col-lg-5 col-md-8 col-sm-12 profile-info">
                                            <!-- Upload Logo -->
                                            <div class="form-group">
                                                <div class="header-fullname">Profile Picture</div><br/><br/>
                                                <div id="avatar_message"></div>
                                                <div class="btn btn-info">
                                                    <input type="file" id="fileupload" class="file-input-extensions" name="files[]" data-url="<?=site_url('uploads/upload_avatar')?>" accept="image/*" >
                                                </div>
                                                <span class="help-block">Only JPEG, JPG, GIF and PNG extensions are allowed.</span>
                                            </div>
                                            <!-- /upload logo -->
                                        </div>
                                        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                                    <div class="stats-value palegreen">-</div>
                                                    <div class="stats-title">UPCOMING</div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                                    <div class="stats-value info">-</div>
                                                    <div class="stats-title">PENDING</div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                                    <div class="stats-value blueberry">-</div>
                                                    <div class="stats-title">COMPLETED</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                                                    <i class="glyphicon glyphicon-map-marker"></i> -
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                                                    Rating: <strong>-</strong>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                                                    Age: <strong><?=GetAge($user->dob)?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?endif?>

                                <div class="form-title">
                                    Basic Information
                                </div>
                                <div id="message"><?=show_message()?></div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-1">
                                            <div class="form-group">
                                                <label for="registrationInput">Salutation</label>
                                                <?=form_dropdown('salutation', salutation_options(), $user->salutation);?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                           <div class="form-group">
                                            <label for="nameInput">First Name:</label>
                                            <input type="text" class="form-control" name="first_name" value="<?=$user->first_name?>" placeholder="First Name"
                                           />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="nameInput">Last Name:</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?=$user->last_name?>" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="regidateInput">Gender:</label>
                                            <?=form_dropdown('gender', gender_options(), $user->gender);?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="regidateInput">Date of Birth:</label>
                                            <div class="input-group">
                                                <input class="form-control date-picker date_of_birth" id="id-date-picker-1" type="text" name="dob" value="<?=hdate($user->dob)?>" data-date-format="dd-mm-yy" placeholder="DD/MM/YYYY">
                                                <span class="input-group-addon open-datetimepicker">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3">
                                            <div class="form-group nationality">
                                                <label for="regidateInput">Nationality:</label><br/>
                                                
                                                <?if($user===false):?>
                                                    <?=form_dropdown('nationality-select', nationality_options(), $user->nationality)?>
                                                <input id="nationality" name="nationality" class="hide" value="<?php print $user->nationality; ?>">
                                                <?else:?>
                                                    <?if(!in_array($user->nationality,nationality_options())):?>
                                                        <?=form_dropdown('nationality-select', nationality_options(), 'Other')?>
                                                        <input id="nationality" name="nationality" value="<?php print $user->nationality; ?>">
                                                    <?else:?>
                                                        <?=form_dropdown('nationality-select', nationality_options(), $user->nationality)?>
                                                        <input id="nationality" name="nationality" class="hide" value="<?php print $user->nationality; ?>">
                                                    <?endif?>
                                                <?endif?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="nameInput">NRIC:</label><br/>
                                                <input type="text" class="form-control" name="national_id" value="<?=$user->national_id?>" placeholder="S1234567A"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group race">
                                                <label for="nameInput">Race:</label><br/>
                                                <?if($user===false):?>
                                                    <?=form_dropdown('race-select', race_options(), $user->race);?>
												<input id="race" name="race" class="hide" value="<?php print $user->race; ?>">
                                                <?else:?>
                                                    <?if(!in_array($user->race,race_options())):?>
                                                        <?=form_dropdown('race-select', race_options(), 'Other');?>
												<input id="race" name="race" value="<?php print $user->race; ?>">
                                                    <?else:?>
                                                        <?=form_dropdown('race-select', race_options(), $user->race);?>
												<input id="race" name="race" class="hide" value="<?php print $user->race; ?>">
                                                    <?endif?>
                                                <?endif?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group religion">
                                                <label for="nameInput">Religion:</label> <br/>
                                                <?if($user===false):?>
                                                    <?=form_dropdown('religion-select', religion_options(), $user->religion);?>
                                                    <input id="religion" name="religion" class="hide" value="<?php print $user->religion; ?>">
                                                <?else:?>
                                                    <?if(!in_array($user->religion,religion_options())):?>
                                                        <?=form_dropdown('religion-select', religion_options(), 'Other');?>
                                                    <input id="religion" name="religion" value="<?php print $user->religion; ?>">
                                                    <?else:?>
                                                        <?=form_dropdown('religion-select', religion_options(), $user->religion);?>
                                                        <input id="religion" name="religion" class="hide" value="<?php print $user->religion; ?>">
                                                    <?endif?>
                                                <?endif?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="nameInput">Height:</label><br/>
                                                <input type="text" class="form-control" name="height" value="<?=$user->height?>" placeholder="CM" onkeypress='return isNumberKey(event)' maxlength="3"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="nameInput">Weight:</label>
                                                <input type="text" class="form-control" name="weight" value="<?=$user->weight?>" placeholder="KG" onkeypress='return isNumberKey(event)' maxlength="3"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-title">
                                    Contact Information
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="emailInput">Email: </label>
                                                <input type="text" class="form-control" name="email" value="<?=$user->email?>" placeholder="example@mail.com" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="mobileInput">Home:</label>
                                                <input type="text" class="form-control" name="contact_home" value="<?=$user->contact_home?>" placeholder="99999999" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="mobileInput">H/P:</label>
                                                <input type="text" class="form-control" name="contact_mobile" value="<?=$user->contact_mobile?>" placeholder="99999999"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="nameInput">Postal Code: </label>
                                                <input type="text" class="form-control" name="postal_code" value="<?=$user->postal_code?>" maxlength="5" onkeypress='return isNumberKey(event)'/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="cardInput">Unit. No: </label>
                                                <input type="text" class="form-control" name="unit" value="<?=$user->unit?>" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="cvcInput">Block No.: </label>
                                                <input type="text" class="form-control" name="block" value="<?=$user->block?>"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="cvcInput">Street: </label>
                                                <input type="text" class="form-control" name="street" value="<?=$user->street?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-title">
                                    Other Information
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12 request">
                                            Language(s) that are able to speak fluently<br/>                                                       
                                            <?foreach(languages_array() as $language):?>   
                                                <div class="checkbox">
                                                    <label>
                                                        <?=form_checkbox('language[]', $language, in_array($language, $user->languages), 'class="colored-blue"');?>                                                           
                                                        <span class="text"><?=$language?></span>
                                                    </label>
                                                </div>
                                            <?endforeach?>                                              
                                        </div>
                                    </div>
                                </div>
                                <br/>
                               
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12 request">
                                            Are you suffering from any medical conditions, including neck and back problem?<br/>
                                            <div class="checkbox">
                                                <label>
                                                    <?=form_radio("medical_conditions", 'No', $user->medical_conditions=='No', 'class="colored-blue"')?>
                                                    <span class="text">No</span>
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <?=form_radio("medical_conditions", 'Yes', $user->medical_conditions!='No', 'class="colored-blue"')?>
                                                    <span class="text">Yes</span>
                                                </label>
                                            </div>
                                            <br/><br/>
                                            <div class="form-group">
                                            <label for="xsinput">Specify:</label>
                                            <input type="text" class="form-control"  name="specify" value="<?=str_replace(array('Yes','No'), '', $user->medical_conditions) ?>" id="xsinput" value="I suffer from back problems due to a sports injury">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                              
                                <br/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12 request">
                                            Do you have a smart phone?<br/>
                                            <div class="checkbox">
                                                <label>
                                                    <?=form_radio("smart_phone", 1, $user->smart_phone==1, 'class="colored-blue"')?>
                                                    <span class="text">No</span>
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                     <?=form_radio("smart_phone", 0, $user->smart_phone==0, 'class="colored-blue"')?>
                                                    <span class="text">Yes</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-title">
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6 pull-right">
                                        <input class="btn btn-palegreen pull-right" type="submit" value="Save" />
                                    </div>
                                </div>
                            <input type="hidden" name="user_type" value="CarePro" />
                            <input type="hidden" name="user_id" value="<?=$user->user_id?>" />
                        <?=form_close()?>


                    </div>

                </div>
                <br/>
<!--                <div class="widget">
                    <div class="widget-header bg-palegreen">
                        <i class="widget-icon fa fa-arrow-down"></i>
                        <span class="widget-caption">Cases In-charge</span>
                        <div class="widget-buttons">
                            <a href="#" data-toggle="collapse">
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>Widget Buttons
                    </div>Widget Header
                    <div class="widget-body">

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">

                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead class="bordered-palegreen">
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    Date Requested
                                                </th>
                                                <th>
                                                    Care Recipient
                                                </th>
                                                <th>
                                                    Visit No.
                                                </th>
                                                <th>
                                                    Payment
                                                </th>
                                                <th>
                                                    Remarks
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    2-Apr-16
                                                </td>
                                                <td>
                                                    <a href="case_detail.html">Siah Hong Siew</a>
                                                </td>
                                                <td>
                                                    02042016
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    100.00
                                                </td>
                                                <td>
                                                    Paid
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    23-Mar-16
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);">Siah Hong Siew</a>
                                                </td>
                                                <td>
                                                    23032016
                                                </td>
                                                <td>
                                                    <span class="badge badge-default">
                                                        <i class="fa fa-close"></i>
                                                    </span>
                                                    10.00
                                                </td>
                                                <td>
                                                    Collect Cash
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    21-Feb-16
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);">Desmond Tan</a>
                                                </td>
                                                <td>
                                                    21022016
                                                </td>
                                                <td>
                                                    <span class="badge badge-default">
                                                        <i class="fa fa-close"></i>
                                                    </span>
                                                    100.00
                                                </td>
                                                <td>
                                                    Collect Cash
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4
                                                </td>
                                                <td>
                                                    2-Feb-16
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);">Siah Hong Siew</a>
                                                </td>
                                                <td>
                                                    02022016
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    45.00
                                                </td>
                                                <td>
                                                    Paid
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>Widget Body-->
            </div>
        </div>

    </div>
    <br/><br/>
    <!--/tabs-->
</div>
<!-- /Page Body -->



<script src="<?=asset_url("admin/js/fileuploader/jquery.ui.widget.js")?>"></script>
<script src="<?=asset_url("admin/js/fileuploader/jquery.iframe-transport.js")?>"></script>
<script src="<?=asset_url("admin/js/fileuploader/jquery.fileupload.js")?>"></script>

<script type="text/javascript">

	$(document).ready(function() {

		function dropdownClickOther(name) {

			$(  "." + name + " select" ).change(function() {
				var selected = $( "." + name + " select option:selected" ).text();
				var input = $('#' + name);
				if (selected === 'Other') {
					input.val('');
					input.removeClass('hide');
				}
				else {
					input.addClass('hide');
					input.val(selected);
				}
			});
		}

		var elementsKey = [
			{
				func: dropdownClickOther('nationality')
			},
			{
				func: dropdownClickOther('race')
			},
			{
				func: dropdownClickOther('religion')
			}

		];

		elementsKey.forEach(function(item) {
			item.func;
		});

	});

    var user_id = '<?=$user->user_id?>';
    
    $("#fileupload").fileupload({
        dataType: 'json',
        formData: {csrf:csrf, user_id: user_id},
        done: function (e, data) 
        {  
            if(data.result.url){    
                $("#user-avatar").attr('src', data.result.url); 
            }
            if(data.result.error){
                ShowError(data.result.error, '#avatar_message');
            }           
        },              
        fail: function (e, data) {           
            ShowError(data.result.error, '#avatar_message');           
        },
        progressall: function (e, data) {
            $("#user-avatar").attr('src', base_url + "assets/admin/img/ajax-loader.gif");
        }           
    });

$('.open-datetimepicker').click(function(){
$('.date_of_birth').datepicker('show');
});

</script>