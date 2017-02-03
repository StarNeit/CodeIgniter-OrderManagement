<section class="container wizard-content update-profile">
    <?=form_open(care_url("profile/save"), 'onsubmit="return SendForm(this)" class="update-profile-info"')?>
    <div class="row">
          <div class="col-sm-12">
            <div id="message"><?=show_message()?></div>
          </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <ul class="profile-menu clearfix">
                <ul class="profile-menu clearfix">
                    <li class="active"><a href="<?=care_url("profile/edit")?>">Update Profile</a></li>
                    <li><a href="<?=care_url("profile/account")?>">Account Settings</a></li>
                </ul>
            </ul>

            <h2>Update Profile</h2>
        </div>
    </div>
          <div class="col-xs-12 col-sm-6">
              <div class="user-img">
                <div id="avatar_message"></div>
                <div id="userimage" class="dropzone ">
                   <img id="user-avatar" src="<?=get_s3_file('carepro',$user->photo,$user->id,"avatar","big")?>" alt="" class="header-avatar" onclick="$('#fileupload').click();" style="cursor:pointer"/>
                   <div class="fileinput-button text-center">
                      <a class="btn btn-primary btn-sm"> Upload Photo
                      <input type="file" id="fileupload" name="files[]" data-url="<?=site_url('uploads/upload_avatar')?>" accept="image/*" style="border:none; background: none">
                      </a>
                    <div><small>Only JPEG, JPG, GIF and PNG extensions are allowed.</small></div>
                </div>
                 </div>
              </div>

          </div>
          <div class="col-xs-12 col-sm-6">             
                  <ul>
                      <li>
                          <label for="name">First Name</label>
                          <input type="text" name="first_name" value="<?=$user->first_name?>">
                      </li>
                      <li>
                          <label for="district">Last Name</label>
                          <input type="text" name="last_name" value="<?=$user->last_name?>">
                      </li>
                      <li class="half-form">
                          <ul class="clearfix">
                              <li>
                                  <label for="gender">Gender</label>
                                  <?=form_dropdown('gender', gender_options(), $user->gender);?>
                              </li>
                              
                              <li class="race">
                                  <label for="race">Race</label>
                                  <?if(!in_array($user->race,race_options())):?>
                                    <?=form_dropdown('race-select', race_options(), 'Other');?>
                                  <?else:?>
                                    <?=form_dropdown('race-select', race_options(), $user->race);?>
                                  <?endif?>
                                  
                              </li>
                            </ul>
                      </li>
                          
                        <li class="half-form"> 
                            <ul class="clearfix hide-race">
                                <li class="<?=!in_array($user->race,race_options()) ? '':'hide'?>"></li>
                                <li>
                                    <label for="race" class="<?=!in_array($user->race,race_options()) ? '':'hide'?>">Please Specify</label>
                                <?if($user===false):?>
                                     <input id="race" name="race" class="hide" value="<?php print $user->race; ?>">
                                 <?else:?>
                                     <?if(!in_array($user->race,race_options())):?>
                                        <input id="race" name="race" value="<?php print $user->race; ?>" placeholder='Other Race'>
                                     <?else:?>
                                         <input id="race" name="race" class="hide" value="<?php print $user->race; ?>">
                                     <?endif?>
                                 <?endif?>   
                                </li>
                            </ul>
                        </li>  
                          
                          
                        <?php /*<li class="half-form">
                          <ul class="clearfix">  
                              <li class="hide race-hide">
                                <label class="hide"></label>
                                <input value="<?=$user->race?>" name="race" id="race" class="hide">
                          </ul>
                        </li>*/?>
                      <li>
                          <label for="birthday">Date of Birth</label>
                          <input type="text" name="dob" value="<?=hdate($user->dob)?>"  placeholder="DD/MM/YYYY" class="datepicker inp-bg-arrow">
                      </li>
                  </ul>
             
          </div>
      </div>

      <div class="row clearfix">
          <div class="col-xs-12"><br/><br/>
            <label for="name">Summary Profile</label>
            <textarea name='summary' rows='6' style='color:#646464;padding:5px'><?=nl2br($user->summary)?></textarea>
            </div>
      </div>
      <div class="row">
          <div class="col-xs-12">
            <div class="care-title">Type of Care</div>

            <?php $this->load->view('includes/services_view', array('skills' => $user->skills));?>

       
          </div>
      </div>
      <div class="row">
          <div class="col-xs-12 clearfix">
              <button class="btn-main btn-next">Update</button>
          </div>
      </div>
     <?=form_close()?>
</section>


<!--Modal-window-->

<div id="myModalBox_update" class="modal fade update-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title-modal">Thank you! We will proceed with the phone interview if you are shortlisted.</div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 active">
                                    <span class="fa fa-file-o" aria-hidden="true"></span>
                                    <h3>Online Application</h3>
                                    <p>You have completed the online application.</p>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <span class="fa fa-phone" aria-hidden="true"></span>
                                    <h3>Phone Interview</h3>
                                    <p>Our staff will chat with you to develop a better understanding.</p>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <span class="fa fa-users" aria-hidden="true"></span>
                                    <h3>Face-to-Face Interview</h3>
                                    <p>You will be invited to our office for a short interview and introduction to Homage.</p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-default btn-modal-inner" data-dismiss="modal">Proceed</button>
                        </div>
                    </div>
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

      var user_id = '<?=$user->user_id?>';
      
      $("#fileupload").fileupload({
          dataType: 'json',
          formData: {csrf:csrf, user_id: user_id},
          done: function (e, data) 
          {  
              if(data.result.big_url){    
                  $("#user-avatar").attr('src', data.result.big_url); 
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
<script type="text/javascript">

$(document).ready(function() {

    function dropdownClickOther(name) {

            $(  "." + name + " select" ).change(function() {
                    var selected = $( "." + name + " select option:selected" ).text();
                    var input = $('#' + name);
                    if (selected === 'Other') {
                        $('.hide-race li').removeClass('hide');
                        $('.hide-race li:eq(1) label').removeClass('hide');
                            input.val('');
                            input.removeClass('hide');
                    }
                    else {
                        $('.hide-race li').addClass('hide');
                        $('.hide-race li:eq(1) label').addClass('hide');
                            input.addClass('hide');
                            input.val(selected);
                    }
            });
    }

    var elementsKey = [
            {
                    func: dropdownClickOther('race')
            },


    ];

    elementsKey.forEach(function(item) {
            item.func;
    });

});
</script>
