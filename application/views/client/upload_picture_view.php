<section class="container wizard-content payment-record">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <span class="fa fa-clock-o"></span>
                    <span>Schedule Visit</span>
                </li>
                <li class="selected">
                    <span class="fa fa-lock"></span>
                    <span>Payment Matters</span>
                </li>
                <li class="selected">
                    <span class="fa fa-user-plus"></span>
                    <span>Upload Picture</span>
                </li>
            </ul>
            <?=form_open(client_url("wizard/save_upload"), 'onsubmit="return SendForm(this)"')?>
              <h2>Upload profile picture</h2>
              <div id="message"><?=show_message()?></div>
              <div class="user-img">
                  <div id="avatar_message"></div>
                  <div id="userimage" class="dropzone ">
                     <img id="user-avatar" src="<?=get_s3_file('recipient',$recipient->photo,$recipient->id,"avatar","big")?>" alt="" class="header-avatar" />
                     <div class="fileinput-button text-center">
                        <a class="btn btn-primary btn-sm" type="button"> Upload Photo
                          <input type="file" id="fileupload" name="files[]" data-url="<?=site_url('uploads/upload_recipient_photo')?>" accept="image/*" s>
                          <input type="hidden" name="photo" value="" id="photo"/>
                          <input type="hidden" name="photo_thumb" value="" id="photo_thumb"/>
                        </a>
                      <div><small>Only JPEG, JPG, GIF and PNG extensions are allowed.</small></div>
                  </div>
                   </div>
                </div>
              <div class="permission">
                  <label>
                      <input type="checkbox" name="allow" value="1" />
                      <span></span> Allow carepro to take picture of care recipient on first visit and submit to
                      Homage for profile update
                  </label>
              </div>
              <div class="clearfix">
                  <a href="<?=client_url("wizard/payment")?>" class="btn-main btn-back">Back</a>
                  <button class="btn-main btn-next">COMPLETE</button>
                  <input type="hidden" name="case_id" value="<?=$case_id?>" />
              </div>
            <?=form_close()?>
        </div>
    </div>
</section>



<script src="<?=asset_url("admin/js/fileuploader/jquery.ui.widget.js")?>"></script>
<script src="<?=asset_url("admin/js/fileuploader/jquery.iframe-transport.js")?>"></script>
<script src="<?=asset_url("admin/js/fileuploader/jquery.fileupload.js")?>"></script>

<script type="text/javascript">

  $(document).ready(function() {

          var recipient_id = '<?=$recipient->id?>';
        var user_id = '<?=$recipient->user_id?>';
            
      $("#fileupload").fileupload({
          dataType: 'json',
          formData: {csrf:csrf, recipient_id: recipient_id, user_id: user_id},
          done: function (e, data) 
          {  
              if(data.result.big_url){    
                  $("#user-avatar").attr('src', data.result.big_url); 
                  $("#photo").val(data.result.big_url);
                  $("#photo_thumb").val(data.result.url);
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