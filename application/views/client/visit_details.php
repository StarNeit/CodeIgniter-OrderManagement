<section class="container wizard-content case-matches">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?if($visit->status=='Pending'):?>
            <img src="<?=get_s3_file('recipient',$visit->photo,$visit->recipient_id,"avatar/big")?>" class="user-img-load" alt="">
            <?else:?>
            <img src="<?=get_s3_file('carepro',$visit->photo,$visit->user_id,"avatar/big")?>" class="user-img-load" alt="">
            <?endif?>
        </div>
        <div class="col-xs-12 col-sm-6 user-info">
            <h2><?=$visit->name?></h2>

            <div>
                <span class="fa fa-calendar"></span>
                <?if($visit->status=='Completed'):?>
                    <?=visit_period($visit->clock_in, $visit->clock_out)?>
                <?else:?>
                    <?=visit_period($visit->visit_from, $visit->visit_to)?>
                <?endif?>
                
            </div>
            <ul class="clearfix">
                <li>
                    <span>Race : </span>
                    <span><?=$visit->race?></span>
                </li>
                <li>
                    <span>Age : </span>
                    <span><?=calculate_age($visit->dob)?></span>
                </li>
                <li>
                    <span>Weight : </span>
                    <span><?=$visit->weight?></span><span>kg</span>
                </li>
                <li>
                    <span>Height : </span>
                    <span><?=$visit->height?></span><span>cm</span>
                </li>
                <li>
                    <span>Gender   :  </span>
                    <span><?=$visit->gender?></span>
                </li>
                <li>
                    <span>Language : </span>
                    <span><?=implode(',', $visit->language)?></span>
                </li>
            </ul>
            <?if($visit->status == 'Pending'):?>
                <div class="case-info">
                    <a href="javascript:;" class="btn-main btn-next" id="modal-show"><?=$visit->status?></a>
<!--                    <a href="javascript:;" id="popoverData" class="btn" data-content="Popover with data-trigger" rel="popover" data-placement="right" data-trigger="hover">
                        <span class="fa fa-info"></span>-->
                    </a>
                </div>
            <?endif?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?if($visit->status=='Pending'):?>
                <h3 class="half-width-border">Diagnosis</h3>
                <p class="case-matches-description" style="min-height:150px"><?=$visit->diagnosis=='' ? 'No diagnosis':$visit->diagnosis?></p>
                <h3 class="half-width-border">Medical Condition</h3>
                <p class="case-matches-description" style="min-height:150px"><?=$visit->medical_condition=='' ? 'No medical condition':$visit->medical_condition?></p>
            <?endif?>
            <h3 class="half-width-border">Special Instructions</h3>            
            <p class="case-matches-description" style="min-height:150px"><?=$visit->instructions==''?'No Instructions':$visit_instructions?></p>
        </div>
    </div>   
    <div class="row">
        <div class="col-xs-12 col-sm-6 menu-accordion">
            <h3>Service Required</h3>

            <? $this->load->view('includes/services_accordion',array('services'=>$visit->services))?>

            <?if($visit->status!='Pending'):?>
            <h3>Your Matching Skillsets</h3>
            <ul class="abstract clearfix">
                <?foreach($visit->match_skill as $service):?>
                <li class="<?=preg_replace('/\\.[^.\\s]{3,4}$/', '', $service->icon)?>">
                    <div></div>
                    <div><?=$service->service?></div>
                </li>
                <?endforeach?>
            </ul>
            <?endif?>
        </div>
        <div class="col-xs12 col-sm-6">
            <h3>Past Visit Summary</h3>
            <?if($visit->summary!==false):?>
                <ul class="past-visit-summary">
                <?foreach($visit->summary as $v):?>
                    <li>
                        <p class="case-matches-description"><?=get_substr($v->summary, 120)?></p>
                        <a href="javascript:void(0)" class="review-more">
                            <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>
                <?endforeach?>              
            </ul>
            <?else:?>
                <div align="center">There has been no previous visits for <?=$visit->recipient_name?></div>
            <?endif?>
        </div>
    </div>
</section>



<!--<div id="myModalBox-bid" class="modal fade case-matches-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title-modal">Confirm Bidding ?</div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>By bidding, you are confirming that you will be available for this case.
                                        After the client accepts your bid, you cannot back out.</p>
                                </div>
                                <div class="clearfix">
                                    <a class="btn-main btn-back" data-dismiss="modal">Back</a>
                                    <a class="btn-main btn-next" data-dismiss="modal">Yes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
