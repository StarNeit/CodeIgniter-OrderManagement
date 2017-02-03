<section class="container wizard-content case-matches">
    <div class="row">
          <div class="col-sm-12">
            <div id="message"><?=show_message()?></div>
          </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <img src="<?=get_image(PHOTOS . 'big/'.$recipient->photo)?>" class="user-img-load" alt="">
        </div>
        <div class="col-xs-12 col-sm-6 user-info">
            <h2><?=$recipient->full_name?></h2>

            <div>
                <span class="fa fa-calendar"></span>
                <?php 
                    if($visit->status!='completed') {
                        $date_from = $visit->visit_from;
                        $date_to = $visit->visit_to;
                        }else{
                        $date_from = $visit->clock_in;
                        $date_to = $visit->clock_out;
                    } 
                ?>
                <?if(strtotime(date('Y-m-d',strtotime($date_from)))!=strtotime(date('Y-m-d',strtotime($date_to)))):?>
                    <span><?=date('d M',strtotime($date_from))?> </span>
                    <span>to</span>
                <?endif?>
                <span><?=date('d M',strtotime($date_to))?></span>
                <span><?=date('h:i A',strtotime($date_from))?></span> - <span><?=date('h:i A',strtotime($date_to))?></span>
            </div>
            <ul class="clearfix">
                <li>
                    <span>Race : </span>
                    <span><?=$recipient->race?></span>
                </li>
                <li>
                    <span>Age : </span>
                    <span><?=calculate_age($recipient->dob)?></span>
                </li>
                <li>
                    <span>Weight : </span>
                    <span><?=$recipient->weight?></span><span>kg</span>
                </li>
                <li>
                    <span>Height : </span>
                    <span><?=$recipient->height?></span><span>cm</span>
                </li>
                <li>
                    <span>Gender   :  </span>
                    <span><?=$recipient->gender?></span>
                </li>
                <li>
                    <span>Language : </span>
                    <span><?=implode(', ', $case->languages)?></span>
                </li>
                <?if($visit->status=='Completed' || $visit->status=='Assigned'): ?>
                    <li><span>Fee  : SGD $20</span></li>
                    <li></li>
                <?endif?>
                <li>
                    <span>Address  : </span>
                    <?php 
                    $tmp = array();
                    $tmp[] = $visit->unit;
                    $tmp[] = $visit->block;
                    $tmp[] = $visit->building;
                    $tmp[] = $visit->street;
                    $tmp[] = $visit->postal_code;
                    ?>
                    <span><?=implode(", ",array_filter($tmp))?></span>
                </li>
            </ul>
                <div class="case-info">
                    <?if($visit->status=='Pending' && $visit->visit_carepro_status==''):?>
                        <a href="javascript:;" class="btn-main btn-next" id="modal-show">BID FOR CASE</a>
                    <?else:?>
                        <a href="javascript:;" class="btn-main btn-next"><?=$visit->status;?></a>
                    <?endif?>
<!--                    <a href="javascript:;" id="popoverData" class="btn" data-content="Popover with data-trigger" rel="popover" data-placement="right" data-trigger="hover">
                        <span class="fa fa-info"></span>
                    </a>-->
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3 class="half-width-border">Diagnosis</h3>
            <p class="case-matches-description" style="min-height:150px"><?=$recipient->diagnosis=='' ? 'No diagnosis':$recipient->diagnosis?></p>
            <h3 class="half-width-border">Medical Condition</h3>
            <p class="case-matches-description" style="min-height:150px"><?=$recipient->medical_condition=='' ? 'No medical condition':$recipient->medical_condition?></p>

            <h3 class="half-width-border">Special Instructions</h3>            
            <p class="case-matches-description" style="min-height:150px"><?=$visit->instructions=='' ? 'No instruction':$visit->instructions?></p>
        </div>
    </div>   
    <div class="row">
        <div class="col-xs-12 col-sm-6 menu-accordion">
            <h3>Service Required</h3>
            <? $this->load->view('includes/services_accordion')?>

            <h3>Your Matching Skillsets</h3>
            <ul class="abstract clearfix">
                <?foreach($matching_services as $service):?>
                <li class="<?=preg_replace('/\\.[^.\\s]{3,4}$/', '', $service->icon)?>">
                    <div></div>
                    <div><?=$service->service?></div>
                </li>
                <?endforeach?>
            </ul>
        </div>
        <div class="col-xs12 col-sm-6">
            <h3>Past Visit Summary</h3>
            <?if($past_visits!==false):?>
                <ul class="past-visit-summary">
                <?foreach($past_visits as $v):?>
                    <li>
                        <p class="case-matches-description"><?=get_substr($v->summary, 120)?></p>
                        <a href="<?=care_url("cases/bid/$v->id")?>" class="review-more">
                            <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>
                <?endforeach?>              
            </ul>
            <?else:?>
                <div align="center">There has been no previous visits for <?=$recipient->full_name?></div>
            <?endif?>
        </div>
    </div>
</section>


<?if($visit->status=='Pending' && $visit->visit_carepro_status==''):?>
<?=form_open(care_url("cases/bid_visit"), 'id="save_bid" onsubmit="return SendForm(this)"')?>
<div id="myModalBox-bid" class="modal fade case-matches-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
          <div class="col-sm-12">
            <div id="message"><?=show_message()?></div>
          </div>
    </div>
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
                                    <input type="submit" class="btn-main btn-next" value="Yes"/>
                                    <input type='hidden' id='visit_id' name="visit_id" value="<?=$visit->id?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?=form_close()?>
<?endif?>