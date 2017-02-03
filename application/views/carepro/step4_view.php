<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <a href="javascript:void(0)">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <span>Personal Particulars</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="javascript:void(0)">
                        <span class="fa fa-wrench" aria-hidden="true"></span>
                        <span>Skills &amp; Qualifications</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="javascript:void(0)">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <span>Background Check</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="javascript:void(0);">
                        <span class="fa fa-lock" aria-hidden="true"></span>
                        <span>Submit Documents</span>
                    </a>
                </li>
                <li>
                    <span class="fa fa-file-text-o" aria-hidden="true"></span>
                    <span>Information Declaration</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="title-form-personal">&lt; Maximum upload size is 2 MB &gt;</div>
            <div id="message"><?=show_message()?></div>


            <?=form_open(care_url('wizard/save_step4'), 'onsubmit="return SendForm(this)"')?>
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
          
             
                <div class="clearfix">
                    <!-- <a href="<?=care_url("wizard/step3")?>" class="btn-main btn-back">Back</a> -->
                    <button class="btn-main btn-next">Next</button>
                </div>
            <?=form_close()?>
        </div>
    </div>
</section>  

<? $this->load->view('carepro/docs_script')?>