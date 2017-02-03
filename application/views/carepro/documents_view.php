<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <h2>My Documents</h2>
            <div id="message"><?=show_message()?></div>
            <?=form_open(care_url('documents/update'), 'onsubmit="return SendForm(this)"')?>
                 <ul class="upload">
                    
                    <?foreach(documents_options() as $type => $title):?>
                        <li>
                            <div class="upload-info">
                                <div><?=$title?></div>                           
                            </div>

                            <div id="<?=$type?>_documents">
                                <? $this->load->view('carepro/doc_list', array('documents' => element($type, $user->documents, array()), 'type' => $type))?>                          
                            </div>

                            <div id="<?=$type?>_message"></div>
                            <label class="file_upload">
                                <span class="button file-area">Upload</span>
                                <!--<mark>Drag and Drop your Documents here</mark>-->
                                <input type="file" class="fileupload" multiple name="files[<?=$type?>]" data-url="<?=site_url("uploads/upload_doc/$type")?>" accept=".docx, application/pdf, application/msword, image/*" data-type="<?=$type?>" >
                            </label>                                        
                        </li>                     
                        
                    <?endforeach?>    
                </ul>
                <div class="pull-right clearfix">
                    <button class="btn-main btn-enter">Update</button>
                </div>
            <?=form_close()?>
        </div>
    </div>
</section>


<? $this->load->view('carepro/docs_script')?>