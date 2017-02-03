<?php $count = 0;?>
<?foreach($documents as $doc):?>
<?php $refID = 'doc-'.$count.'-'.random_hash(4); ?>
    <div class="row" id="<?=$refID;?>">                               
        <div class="col-lg-3">
            <a href="<?=$doc->document_url?>" target="_blank">
                <?=$doc->name?>
            </a>
            <a onclick="removeDoc('<?=$refID;?>');" style="color: red;"> Remove</a>
            <input type="hidden" name="<?=$type?>[document_url][]" value="<?=$doc->document_url?>" />
            <input type="hidden" name="<?=$type?>[name][]" value="<?=$doc->name?>" />
        </div>
        <?if($type == 'CRP'):?>
            <div class="col-lg-6">                                    
                <label class="col-sm-3 control-label no-padding-right">Valid Till</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input class="test form-control date crp_<?=$refID?>" name="<?=$type?>[valid_till][]" value="<?=($doc->valid_till!='0000-00-00' && $doc->valid_till!='') ? hdate($doc->valid_till):''?>" type="text" required placeholder='DD/MM/YYYY'>
                        <span class="input-group-addon" onclick="triggerClick('crp_<?=$refID;?>')">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>  
            </div>     
        <?endif?>  
        <?if($type == 'TB' || $type == 'Certificate'):?>
            <div class="col-lg-6">                                    
                <label class="col-sm-3 control-label no-padding-right">Completion On</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input class="form-control date <?=$type?>_<?=$refID?>" name="<?=$type?>[completion_on][]" value="<?=($doc->completion_on!='0000-00-00' && $doc->completion_on!='') ? hdate($doc->completion_on):''?>" type="text" required placeholder='DD/MM/YYYY'>
                        <span class="input-group-addon" onclick="triggerClick('<?=$type?>_<?=$refID?>')">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>  
            </div>     
        <?endif?>
    </div>    
<?php $count++;?>
<?endforeach?> 
