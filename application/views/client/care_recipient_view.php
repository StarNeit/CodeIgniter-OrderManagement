<section class="container care-recipient">
    <div class="row">
        <?php foreach($items as $item):?>
            <div class="col-xs-12 col-sm-5 col-sm-offset-1">
                <div class="wizard-content care-recipient">
                    <div class="care-recipient-photo">
                        <img src="<?=get_s3_file('recipient',$item->photo,$item->id,"avatar","big",'assets/images/photo_item_1.jpg')?>" alt="">

                        <div class="clearfix">
                            <div><?=$item->full_name?></div>
                            <a href="<?=client_url("wizard/index/$item->id")?>" class="btn-edit"><span class="fa fa-pencil"></span>Edit</a>
                        </div>
                    </div>
                    <div class="care-recipient-info">
                        <ul class="clearfix">
                            <li>
                                <ul>
                                    <li>
                                        <span>Race</span>
                                        <span><?=$item->race?></span>
                                    </li>
                                    <li>
                                        <span>Weight</span>
                                        <span>
                                            <span><?=$item->weight?></span><span>kg</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span>Height</span>
                                        <span>
                                            <span><?=$item->height?></span><span>cm</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span>Gender</span>
                                        <span><?=$item->gender?></span>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li>
                                        <span>Age</span>
                                        <span><?=calculate_age($item->dob)?></span>
                                    </li>
                                    <li>
                                        <span>Language</span>
                                        <span>
                                            <?php foreach($item->languages as $language):?>
                                                <?=$language->language?>
                                            <?php endforeach;?>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="bid-info-services">
                            <div>
                            <span>Services :</span>
                            <?php if (count($item->services)>0) {
                             foreach($item->services as $services):?>
                                <span><?=$services->service?></span>
                                
                            <?php endforeach;}?>
                            </div>
                        </div>
                        <?if($item->staff_updated!='0000-00-00 00:00:00'):?>
                          <a href="<?=client_url("wizard/schedule_visit/$item->id")?>" class="btn-main btn-enter">ADD VISIT</a>
                        <?else:?>
                            <br/><br/>
                        <?endif?>
                        
                    </div>
                </div>
            </div>            
        <?php endforeach;?>

        <div class="col-xs-12 col-sm-5 col-sm-offset-1 add-new-recipient">
            <div class="wizard-content">
                <div>
                    <span class="fa fa-user-plus"></span>

                    <div>add new recipient</div>
                    <a href="<?=client_url("wizard/")?>" class="btn-main btn-enter">ADD</a>
                </div>
            </div>
        </div>
    </div>
</section>

