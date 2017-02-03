<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="bid-number clearfix">
                <ul>
                    <? $func = $this->uri->rsegment(2);?>
                    <? $status = $this->uri->rsegment(3);?>
                    <li class="<?=$func == 'index' && ($status==''||$status=='pending') ? 'active' : ''?>"><a href="<?=care_url('cases')?>">PENDING (<span><?=count($total['pending']);?></span>)</a></li>
                    <li class="<?=$status == 'assigned' ? 'active' : ''?>"><a href="<?=care_url('cases/assigned')?>">UPCOMING (<span><?= count($total['assigned']);?></span>)</a></li>
                    <li class="<?=$status == 'completed' ? 'active' : ''?>"><a href="<?=care_url('cases/completed')?>">COMPLETED (<span><?=count($total['completed']);?></span>)</a></li>
                </ul>
                <a href="<?=care_url("cases/bids")?>" class="btn btn-bid">BID FOR CASE</a>
            </div>
            <div class="table-responsive">
                <table class="table bid-cases case-upcoming">
                    <tr>
                        <th>Cases</th>
                        <th>Details</th>
                        <th></th>
                    </tr>
                    <?if(count($visits)>0):?>
                        <?foreach($visits as $visit):?>
                            <tr>
                                <td>
                                    <div>
                                        <img src="<?=get_s3_file('recipient',$visit->photo,$visit->recipient_id,"avatar/big")?>" alt="">
                                    </div>
                                </td>
                                <td class="bid-info">
                                    <div class="bid-info-more">
                                        <span class="fa fa-calendar"></span>
                                        <?php 
                                            if($status!='completed') {
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
                                        <span><?=date('h:i',strtotime($date_from))?></span> <span><?=date('A',strtotime($date_from))?></span> - <span><?=date('h:i',strtotime($date_to))?></span><span><?=date('A',strtotime($date_to))?></span>
                                    </div>
                                    <div class="visit-view-rating">
                                        <h2><?=$visit->re_fname.' '.$visit->re_lname?></h2>
                                    </div>
                                    <div class="bid-cases-address">
                                        <ul>
                                            <li class="gender">
                                                <span>Gender : </span>
                                                <span>Male</span>
                                            </li>
                                            <li class="age">
                                                <span>Age : </span>
                                                <span>62</span>
                                            </li>
                                        </ul>
                                        <span>Service Venue : </span>
                                        <?php 
                                            $tmp = array();
                                            $tmp[] = $visit->block;
                                            $tmp[] = $visit->street;
                                            $tmp[] = $visit->postal_code;
                                        ?>
                                        <span><?=implode(', ',array_filter($tmp));?></span>
                                    </div>
                                    <div class="bid-info-services">
                                        <div>
                                            <span>Services :</span>
                                            <?php foreach ($visit->services as $services) { ?>
                                                <span><?=$services?></span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </td>
                                <td class="term">
                                    <a href='<?=care_url("cases/bid/$visit->id")?>' class="review-more"><span class="fa fa-chevron-right"></span></a>
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
