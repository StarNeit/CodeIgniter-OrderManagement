
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
                   $('.standard_date').datepicker({dateFormat: "dd/mm/yy", changeMonth:true, changeYear: true, yearRange: "-20:+10"});
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