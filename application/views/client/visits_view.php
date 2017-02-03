<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="bid-number clearfix">
                <ul>
                <? $func = $this->uri->rsegment(2);?>
                <? $status = $this->uri->rsegment(3);?>
                    <li class="<?=$func == 'index' && $status=='' ? 'active' : ''?>"><a href="<?=client_url('visits')?>">PENDING (<span><?=count($total['pending']);?></span>)</a></li>
                    <li class="<?=$status == 'assigned' ? 'active' : ''?>"><a href="<?=client_url('visits/assigned')?>">UPCOMING (<span><?=count($total['assigned']);?></span>)</a></li>
                    <li class="<?=$status == 'completed' ? 'active' : ''?>"><a href="<?=client_url('visits/completed')?>">COMPLETED (<span><?=count($total['completed']);?></span>)</a></li>
                    <!--<li><a href="#">COMPLETED</a></li>-->
                </ul>
            </div>
            <div class="table-responsive appointment">
                <table class="table bid-cases visit-view">
                    <?if(count($visits)>0):?>
                        <?foreach($visits as $visit):?>
                            <tr>
                                <? if ($func == 'index' && $status==''): ?>
                                <td>
                                    <div>
                                        <img src="<?=get_s3_file('recipient',$visit->photo,$visit->recipient_id,"avatar/big",'','assets/images/photo_item_01.jpg')?>" alt="">
                                    </div>
                                </td>
                                <td class="bid-info">
                                    <div class="bid-info-more">
                                        <span class="fa fa-calendar"></span>
                                        <?if(strtotime(date('Y-m-d',strtotime($visit->visit_from)))!=strtotime(date('Y-m-d',strtotime($visit->visit_to)))):?>
                                            <span><?=date('d M',strtotime($visit->visit_from))?> </span>
                                            <span>to</span>
                                        <?endif?>
                                        <span><?=date('d M',strtotime($visit->visit_to))?></span>
                                        <span><?=date('h:i',strtotime($visit->visit_from))?></span> <span><?=date('A',strtotime($visit->visit_from))?></span> - <span><?=date('h:i',strtotime($visit->visit_to))?></span><span><?=date('A',strtotime($visit->visit_to))?></span>
                                    </div>
                                    <div class="visit-view-rating">
                                        <h2><?=$visit->fname.' '.$visit->lname?>
                                        </h2>
                                    </div>
                                <?if($status!=''):?>
                                    <ul>
                                        <li>
                                            <span>Age:</span>
                                            <span><?=GetAge($visit->carepro_dob)?></span>
                                            <span>,</span>
                                            <span><?=$visit->carepro_gender?></span>
                                        </li>
                                    </ul>
                                <?else:?>
                                <br/>
                                <?endif?>
                                    <div class="bid-info-services">
                                        <div>
                                            <span>Services :</span>
                                            <?php foreach ($visit->services as $services) { ?>
                                                <span><?=$services->service?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <? else: ?>
                                <td>
                                    <div>
                                        <img src="<?=get_s3_file('carepro',$visit->usr_photo,$visit->usr_id,"avatar/big",'','assets/images/photo_item_01.jpg')?>" alt="">
                                    </div>
                                </td>
                                <td class="bid-info">
                                    <div class="bid-info-more">
                                        <span class="fa fa-calendar"></span>
                                        <?if($status=='assigned'):?>
                                            <?if(strtotime(date('Y-m-d',strtotime($visit->visit_from)))!=strtotime(date('Y-m-d',strtotime($visit->visit_to)))):?>
                                            <span><?=date('d M',strtotime($visit->visit_from))?> </span>
                                            <span>to</span>
                                        <?endif?>
                                        <span><?=date('d M',strtotime($visit->visit_to))?></span>
                                        <span><?=date('h:i',strtotime($visit->visit_from))?></span> <span><?=date('A',strtotime($visit->visit_from))?></span> - <span><?=date('h:i',strtotime($visit->visit_to))?></span><span><?=date('A',strtotime($visit->visit_to))?></span>
                                        <?else:?>
                                            <?if(strtotime(date('Y-m-d',strtotime($visit->clock_in)))!=strtotime(date('Y-m-d',strtotime($visit->clock_out)))):?>
                                            <span><?=date('d M',strtotime($visit->clock_in))?> </span>
                                            <span>to</span>
                                        <?endif?>
                                        <span><?=date('d M',strtotime($visit->clock_out))?></span>
                                        <span><?=date('h:i',strtotime($visit->clock_in))?></span> <span><?=date('A',strtotime($visit->clock_in))?></span> - <span><?=date('h:i',strtotime($visit->clock_out))?></span><span><?=date('A',strtotime($visit->clock_out))?></span>
                                        <?endif?>
                                        
                                    </div>
                                    <div class="visit-view-rating">
                                        <h2><span><?=$visit->carepro->first_name.' '.$visit->carepro->last_name?></span><span>( <?=$visit->fname.' '.$visit->lname?> )</span></h2>
                                    </div>
                                    <ul>
                                        <li>
                                            <span>Age:</span>
                                            <span><?=GetAge($visit->carepro_dob)?></span>
                                            <span>,</span>
                                            <span><?=$visit->carepro_gender?></span>
                                        </li>
                                    </ul>
                                    <div class="bid-info-services">
                                        <div>
                                            <span>Services :</span>
                                            <?php foreach ($visit->services as $services) { ?>
                                                <span><?=$services->service?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                </td>
                                <td class="term">
                                    <a href="<?=base_url('client/visits/details/'.$visit->id)?>" class="review-more"><span class="fa fa-chevron-right"></span></a>
                                </td>
                            </tr>
                        <?endforeach?>
                    <?else:?>
                    <tr><td colspan="3" align="center" style="background-color:white">No Record Found!</td></tr>
                    <?endif?>
                </table>
            </div>
        </div>
    </div>
</section>
