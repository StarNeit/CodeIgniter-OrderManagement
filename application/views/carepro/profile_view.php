<section class="container wizard-content preview-profile">
    
    <div class="row">
          <div class="col-sm-12">
            <div id="message"><?=show_message()?></div>
          </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <img src="<?=get_s3_file('carepro',$user->photo,$user->user_id,"avatar","big")?>" class="user-img-load" alt="">
        </div>
        <div class="col-xs-12 col-sm-6 user-info">
            <a class="btn btn-warning" href="<?=care_url("profile/edit")?>">Edit Profile</a>
            <h2><?=$user->full_name?></h2>

            <?php if($user->is_verified):?>
                <div>
                    <span class="fa fa-check-circle"></span>Verified by Homage
                </div>
            <?php endif;?>

            <ul class="clearfix">
                <li class="half-width">
                    <span>Gender   :  </span>
                    <span><?=$user->gender?></span>
                </li>
                <li class="half-width">
                    <span>Age   :  </span>
                    <span><?=calculate_age($user->dob)?></span>
                </li>
                <li>
                    <span>Race  : </span>
                    <span><?=$user->race?></span>
                </li>
                <li>
                    <span>Rating : </span>
                    <span>
                        <input type="hidden" class="rating" data-filled="fa fa-star" data-empty="fa fa-star-o" value="<?=$rating?>"
                               data-readonly/>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-7">
            <h3>Profile Summary</h3>

            <p><?=nl2br($user->summary)?></p>
        </div>
        <div class="col-xs-12 col-sm-5 menu-accordion">
            <h3>Skill Set</h3>
            <div class="panel-group" id="accordion">
                <?php foreach($services as $service):?>                   
                    <div class="panel panel-default">                        
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#service<?=$service->id?>" class="accordion-toggle collapsed">
                                    <img src="assets/images/<?=$service->icon?>" alt="<?=$service->service?>" class="img img-circle img-service">
                                    <?=$service->service?>
                                </a>
                            </h4>
                        </div>
                        <div id="service<?=$service->id?>" class="panel-collapse collapse">
                           
                            <div class="panel-body">
                                <ul>
                                    <?php foreach($service->skills as $skill):?>
                                        <li><a href="javascript:;"><?=$skill->skill?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>               
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-12">
            <video id="video">
                <source src="assets/video/cat.mp4" type="video/mp4">
                <source src="assets/video/cat.ogv" type="video/ogg">
            </video>
            <a href="#" id="btn-play"></span></a>
        </div>
    </div>
    <?if(count($tasks)>0):?>
    <div class="row">
        <div class="col-xs-12">
            <h3>Previous Tasks / Ratings</h3>
            <ul class="previous-task-rating">
                <?php foreach ($tasks as $task) { ?>
                    <li>
                        <div class="clearfix">
                            <div class="pull-left dates">
                                <?=date("j M Y",strtotime($task->visit_from))?>
                            </div>
                            <div class="pull-right rating-review">
                                <span>Rating</span>
                                <input type="hidden" class="rating" data-filled="fa fa-star" data-empty="fa fa-star-o" value="<?=$task->rating?>"
                                       data-readonly/>
                            </div>
                        </div>
                        <div class="review">
                            <blockquote>
                                <p><?=$task->summary?></p>
                            </blockquote>
                            <ul class="abstract">
                              <?php foreach($services as $service):?>
                             <li><img src="assets/images/<?=$service->icon?>" alt="<?=$service->service?>" class="img img-circle img-service"><?=$service->service?></li>
                            <?php endforeach;?> 
                            </ul>
                            <a href="#" class="review-more"><span class="fa fa-chevron-right"></span></a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?endif?>
</section>
