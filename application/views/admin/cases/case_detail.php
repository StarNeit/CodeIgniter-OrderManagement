<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=admin_url()?>">Home</a>
            </li>
            <li><a href="<?=admin_url("cases")?>">Cases</a></li>
            <li class="active"><?=$title?></li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->
    <!-- Page Header -->
    <div class="page-header position-relative">
        <div class="header-title">
            <h1>
                <?=$title?>
            </h1>
        </div>
    </div>
    <!-- /Page Header -->
    <!-- Page Body -->
    <div class="page-body">

        <div class="tabbable">
        <?php $this->load->view("admin/cases/cases_tabs");?>
<!--             <ul class="nav nav-tabs" id="myTab7">
                <li class="active">
                    <a href="<?=admin_url("cases/detail/")?>">
                        Personal Info
                    </a>
                </li>
                <li class="tab-red">
                    <a href="javascript:void(0)">
                        Visit Request
                        <span class="badge badge-success">
                            1
                        </span>
                    </a>
                </li>
                <li class="tab-red">
                    <a href="javascript:void(0)">
                        Visit History
                    </a>
                </li>
            </ul> -->

            <div class="tab-content radius-bordered">
                <div class="tab-pane in active">
                    <?=form_open(admin_url("cases/save_details"), 'onsubmit="return SendForm(this)" class="form-horizontal"' )?>

                        <div class="form-title">
                            About Care Recipient 
                            
                            (<a href="<?=admin_url("client/details/$client->id")?>"><?=$client->full_name?></a>'<?=$recipient->relationship?>)
                            <a href="<?=admin_url("client/details/$client->id")?>" class="btn btn-info btn-sm btn-follow" target="_blank">
                                <i class="fa fa-user"></i>
                                View Client  
                            </a>
                        </div>

                        <div class="profile-container">
                            <div class="profile-header row">
                                <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                                    <img id="user-avatar" src="<?=get_image(PHOTOS . $recipient->photo)?>" alt="" class="header-avatar" />
                                </div>
                                <div class="col-lg-5 col-md-8 col-sm-12 profile-info">
                                     <!-- Upload Logo -->
                                    <div class="form-group">
                                        <div class="header-fullname">Profile Picture</div><br/><br/>
                                        <div id="avatar_message"></div>
                                        <div class="btn btn-info">
                                            <input type="file" id="fileupload" class="file-input-extensions" name="files[]" data-url="<?=site_url('uploads/upload_recipient_photo')?>" accept="image/*" >
                                        </div>
                                        <span class="help-block">Only JPEG, JPG, GIF and PNG extensions are allowed.</span>
                                    </div>
                                    <!-- /upload logo -->
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                            <div class="stats-value palegreen">0</div>
                                            <div class="stats-title">UPCOMING</div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                            <div class="stats-value info">0</div>
                                            <div class="stats-title">PENDING</div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                            <div class="stats-value blueberry">0</div>
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
                                            Age: <strong>-</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-title">
                            Basic Information
                        </div>
                        <div id="message"><?=show_message()?></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="registrationInput">Salutation</label>
                                        <?=form_dropdown('salutation', salutation_options(), $recipient->salutation);?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">First Name:</label>
                                        <input type="text" name="first_name" value="<?=$recipient->first_name?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">Last Name:</label>
                                        <input type="text" name="last_name" value="<?=$recipient->last_name?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="regidateInput">Gender:</label>
                                        <?=form_dropdown('gender', gender_options(), $recipient->gender);?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="regidateInput">Date of Birth:</label>
                                        <div class="input-group">
                                            <input type="text" name="dob" value="<?=hdate($recipient->dob)?>" class="form-control date_of_birth" placeholder="DD/MM/YY">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">NRIC:</label>
                                        <input type="text" name="nric" value="<?=$recipient->nric?>" class="form-control" placeholder="S1394942Z">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="nameInput">Race:</label><br/>
                                        <?=form_dropdown('race', race_options(), $recipient->race);?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">Height:</label>
                                        <input type="text" name="weight" value="<?=$recipient->weight?>" class="form-control" placeholder="KG">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">Weight:</label>
                                        <input type="text" name="height" value="<?=$recipient->height?>" class="form-control"placeholder="CM">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-title">
                            Medical Condition
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <textarea name="medical_condition"  rows="10" class="form-control"><?=$recipient->medical_condition?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-title">
                            Diagnosis
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <textarea name="diagnosis" id="diagnosis" rows="10" class="form-control"><?=$recipient->diagnosis?></textarea>
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
                        <input type="hidden" name="recipient_id" value="<?=$recipient->id?>"/>
                    <?=form_close()?>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?=asset_url("admin/js/fileuploader/jquery.ui.widget.js")?>"></script>
<script src="<?=asset_url("admin/js/fileuploader/jquery.iframe-transport.js")?>"></script>
<script src="<?=asset_url("admin/js/fileuploader/jquery.fileupload.js")?>"></script>

<script type="text/javascript">

    $(document).ready(function() {       

        var recipient_id = '<?=$recipient->id?>';
        
        $("#fileupload").fileupload({
            dataType: 'json',
            formData: {csrf:csrf, recipient_id: recipient_id},
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
    });
</script>