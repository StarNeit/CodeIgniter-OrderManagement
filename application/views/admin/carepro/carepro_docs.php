<div class="page-content">

    <? $this->load->view("admin/carepro/carepro_breadcrumbs");?>

    <div class="page-body">
        <!-- Tabs -->
        
        <div class="tabbable">

            <? $this->load->view("admin/carepro/carepro_tabs")?>

            <div class="tab-content radius-bordered">
                <div class="tab-pane in active">

                    <?=form_open(admin_url("carepro/save_documents"), 'onsubmit="return SendForm(this)" class="form-horizontal"')?>
             
                        <div id="message"><?=show_message()?></div>

                        <?foreach(documents_options() as $type => $title):?>

                            <div class="form-title">
                               <?=$title?>
                            </div>                          

                            <div id="<?=$type?>_documents">
                                <? $this->load->view('admin/carepro/documents_list', array('documents' => element($type, $user->documents, array()), 'type' => $type))?>
                            </div>

                            <div id="<?=$type?>_message"></div>

                             <div class="fileinput-button">
                                <span class="btn btn-info">
                                    <input type="file" class="fileupload" multiple name="files[<?=$type?>]" data-url="<?=admin_url("carepro/upload_doc/$type")?>" accept=".docx, application/pdf, application/msword, image/*" data-type="<?=$type?>" >
                                    <i class="glyphicon glyphicon-upload"></i> Upload 
                                </span>     
                                <br/>
                                <span class="d">Only Images and Doc files are accepted</span>                       

                            </div>                         
                            <br/>
                        <?endforeach?>                       

                     
                       
                        <div class="form-title">
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 pull-right">
                                <input type="hidden" name="user_id" value="<?=$user->user_id?>" />
                                <input class="btn btn-palegreen pull-right" type="submit" value="Save" />
                            </div>
                        </div>
                    <?=form_close()?>                   
                </div>

            </div>


        </div>
    </div>
    <input type="hidden" class="date"/>




<script src="<?=asset_url("admin/js/fileuploader/jquery.ui.widget.js")?>"></script>
<script src="<?=asset_url("admin/js/fileuploader/jquery.iframe-transport.js")?>"></script>
<script src="<?=asset_url("admin/js/fileuploader/jquery.fileupload.js")?>"></script>

<script type="text/javascript">

    $(document).ready(function() {

        var user_id = '<?=$user->user_id?>';
        
        $(".fileupload").fileupload({
            dataType: 'json',
            formData: {csrf:csrf, user_id: user_id, type: 'hriu'},
//            options: {
//            acceptFileTypes: /(\.|\/)(gif|jpe?g|png|doc|docx|pdf)$/i,
//            },
            done: function (e, data) 
            {                  
                $('#'+type+'_message').html('');
                type =  $(this).data('type');
                if(data.result.html){    
                   $("#"+type+"_documents").append(data.result.html);
                   $('.date').datepicker({dateFormat: "dd/mm/yy", changeMonth:true, changeYear: true, yearRange: "-20:+10"});
                }
                if(data.result.error){
                    ShowError(data.result.error, '#'+type+'_message');
                }           
            },              
            fail: function (e, data) { 
                type =  $(this).data('type');                        
                ShowError(data.result.error, '#'+type+'_message');           
            },
            progressall: function (e, data) {
                type =  $(this).data('type');  
                $('#'+type+'_message').html('uploading...');  
            }           
        });
    });

</script>
<script>

function triggerClick(name){
    
    if ($('input.'+name).is(":focus")) 
    {
        $('input.'+name).blur();
    }
    else{
        $('.'+name).focus();
    }
}

function removeDoc(refID) {
    return $('#'+refID).remove();
}
</script>