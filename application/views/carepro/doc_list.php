<?foreach($documents as $doc):?>
    <? $refID = md5($doc->name) ?>
    <div id="<?=$refID;?>" class="clearfix"> 
        <div class="col-md-6">
            <a href="<?=$doc->document_url?>" target="_blank"><?=$doc->name?></a>
            <a onclick="removeDoc('<?=$refID;?>');" style="color: red">Remove</a>
            <input type="hidden" name="<?=$type?>[document_url][]" value="<?=$doc->document_url?>" />
            <input type="hidden" name="<?=$type?>[name][]" value="<?=$doc->name?>" />      
        </div> 
        <div class="col-md-6">
            <?if($type == 'CRP'):?>                                               
                <label>Valid Till:</label>               
                 <input class=" standard_date" name="<?=$type?>[valid_till][]" value="<?=hdate($doc->valid_till)?>" type="text" required placeholder='DD/MM/YYYY'> 
                 
            <?endif?>  
            <?if($type == 'TB' || $type == 'Certificate'):?>                                         
                <label class="">Completion On:</label>                
                <input class=" standard_date" name="<?=$type?>[completion_on][]" value="<?=hdate($doc->completion_on)?>" type="text" required placeholder='DD/MM/YYYY'>   
                  
            <?endif?>
        </div>
    </div>    
<?endforeach?> 
