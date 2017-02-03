<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=admin_url()?>">Home</a>
            </li>
            <li><a href="<?=admin_url("recipients")?>">Recipients</a></li>
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
            

            <div class="tab-content radius-bordered">
                <div class="tab-pane in active">
                    <?=form_open(admin_url("recipients/save_new"), 'onsubmit="return SendForm(this)" class="form-horizontal"' )?>
           

                        <div class="form-title">
                            Basic Information
                        </div>
                        <div id="message"><?=show_message()?></div>
                        <div class="row">
                        <div class="profile-container">
                            <div class="profile-header row">
                                <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                                    <img id="user-avatar" src="<?=get_image(PHOTOS . null)?>" alt="" class="header-avatar" />
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
                            </div>
                            </div>    
                        </div>
                        <div class="row">
                         <div class="col-lg-12">
                        
                            <input type="hidden" name="user_id" value="<?=$user_id?>">
                            <input type="hidden" name="photo" id="user-photo">
                         
                             <div class="col-lg-4">
                                <div class="form-group">
                                <label for="Relationship">Relationship</label>
                                <?=form_dropdown('relationship', relationship_options());?>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="registrationInput">Salutation</label>
                                        <?=form_dropdown('salutation', salutation_options());?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">First Name:</label>
                                        <input type="text" name="first_name" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">Last Name:</label>
                                        <input type="text" name="last_name" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="nameInput">Gender:</label>
                                        <?=form_dropdown('gender', gender_options());?>
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
                                            <input type="text" name="dob" value="" class="form-control date_of_birth" placeholder="DD/MM/YY">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">NRIC:</label>
                                        <input type="text" name="nric" value="" class="form-control" placeholder="S1394942Z">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="nameInput">Race:</label><br/>
                                        <?=form_dropdown('race', race_options());?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">Height:</label>
                                        <input type="text" name="weight" value="" class="form-control" placeholder="CM">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">Weight:</label>
                                        <input type="text" name="height" value="" class="form-control"placeholder="KG">
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
                                    <textarea name="medical_condition"  rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-title">
                            Diagnosis
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <textarea name="diagnosis" id="diagnosis" rows="10" class="form-control"></textarea>
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

        var recipient_id = '0';
        var user_id = '<?=$user_id?>';
        
        $("#fileupload").fileupload({
            dataType: 'json',
            formData: {csrf:csrf, recipient_id: recipient_id, user_id: user_id},
            done: function (e, data) 
            {  
                if(data.result.url){    
                    $("#user-avatar").attr('src', data.result.url); 
                    $("#user-photo").val(data.result.name);
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
