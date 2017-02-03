<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <span class="fa fa-clock-o"></span>
                    <span>Schedule Visit</span>
                </li>
                <li>
                    <span class="fa fa-lock"></span>
                    <span>Payment Matters</span>
                </li>
                <li>
                    <span class="fa fa-user-plus"></span>
                    <span>Upload Picture</span>
                </li>
            </ul>

            <?=form_open(client_url("wizard/save_visit"), 'onsubmit="return SendForm(this)"');?>
                <h2>SCHEDULE A VISIT</h2>  
                <div id="message"><?=show_message()?></div>             
                <div class="care-needs-accordion">
                    <div class="panel-group" id="accordion">
                        <!-- Panel-1 -->
                        <div class="panel panel-default">
                            <!-- Header-panel-1 -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       class="accordion-toggle collapsed">Recipient Profile</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse">
                                <!-- Content-panel-1 -->
                                <div class="panel-body">
                                    <div class="about-info">
                                        <ul>
                                            <li class="half">
                                                <ul>
                                                    <li>
                                                        <label for="postal">Postal Code</label>
                                                        <input type="text" name="postal_code" value="<?=$case->postal_code?>" placeholder="123456">
                                                    </li>
                                                    <li>
                                                        <label for="unit">Unit No.</label>
                                                        <input type="text" name="unit" value="<?=$case->unit?>" placeholder="#01-01">
                                                    </li>
                                                    <li>
                                                        <label for="block">Block No.</label>
                                                        <input type="text" name="block" value="<?=$case->block?>" placeholder="101">
                                                    </li>
                                                    <li>
                                                        <label for="street">Street</label>
                                                        <input type="text" name="street" value="<?=$case->street?>" placeholder="Andrew Avenue">
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Panel-2 -->
                            <div class="panel panel-default">
                                <!-- Header-panel-2 -->
                                <div class="panel-heading">
                                    <h4 class="panel-title ">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                           class="accordion-toggle collapsed care-active">Visit Schedule</a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse in">
                                    <!-- Content-panel-2 -->
                                    <div class="panel-body">
                                        <div>        

                                            <p>Do you require 24hr Care/Live-in care?</p>

                                            <div class="check-button">
                                                <label>
                                                    <?=form_radio('full_day', 1, $case->full_care, 'class="fullday"')?>
                                                    <span></span>
                                                    <span>Yes</span>
                                                </label>
                                                <label>
                                                    <?=form_radio('full_day', 0, ! $case->full_care, 'class="fullday"')?>
                                                    <span></span>
                                                    <span>No</span>
                                                </label>
                                            </div>
                                            <div class="schedule_block fullday_yes" <?=$case->full_care ? '' : 'style="display:none"'?>>

                                                <div class="date-choose">
                                                    <label>Date</label>
                                                    <input type="date" name="fullday_from[]" class="from visit_from0" placeholder="DD/MM/YYYY" min="<?=date('Y-m-d');?>" max="<?=date('Y-m-d', strtotime('30 Days'));?>">
                                                    <label>To</label>
                                                    <input type="date" name="fullday_to[]" class="to visit_to0" placeholder="DD/MM/YYYY" min="<?=date('Y-m-d');?>" max="<?=date('Y-m-d', strtotime('30 Days'));?>">
<!--                                                    <a class="btn-certification add-schedule-block"><span class="fa fa-plus"></span></a>-->
                                                </div>
                                               
                                            </div>
                                            <div class="repeat_block" <?=$case->full_care ? 'style="display:none"' : ''?>>
                                                <p>Do you require this schedule to be repeated?</p>

                                                <div class="check-button">
                                                    <label>
                                                        <input type="radio" name="repeat" value="1" class="repeat" >
                                                        <span></span>
                                                        <span>Yes</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="repeat" value="0" class="repeat" checked >
                                                        <span></span>
                                                        <span>No</span>
                                                    </label>
                                                </div>

                                                <div class="schedule_block one_day_visit">
                                                    <div class="date-choose">
                                                        <label>Date</label>
                                                        <!--input type="text" name="one_day_date"  placeholder="DD/MM/YYYY" class="datepicker_one_day"-->
                                                        <input type="text" name="one_day_date"  placeholder="DD/MM/YYYY" class="datepicker_one_day">
                                                    </div>
                                                    <div class="time-range" >
                                                        <label>Start time</label>
                                                        <input type="time" name="one_day_start" step="3600" />
                                                        <!--?=form_dropdown('one_day_start', time_options(), '');?-->
                                                        <label>To</label>
                                                        <input type="time" name="one_day_end" step="3600" />
                                                        <!--?=form_dropdown('one_day_end', time_options(), '');?-->
                                                    </div>
                                                </div>


                                                <div class="care-week" style="display:none">
                                                   <p>Repeat schedule every:</p>
                                                   <div class="schedule_block">
                                                        <div class="err err_repeat_days"></div>
                                                        <ul class="check-button repeat_days">
                                                            <?foreach(week_days() as $index => $day_name):?>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="repeat_days[0][]" value="<?=$index+1?>">
                                                                    <span></span>
                                                                    <span><?=$day_name?></span>
                                                                </label>
                                                            </li>
                                                            <?endforeach?>                                                  
                                                        </ul>
                                                        <div class="time-range" >
                                                            <label>Start time</label>
                                                            <?=form_dropdown('repeat_start[]', time_options(), '');?>
                                                            <label>To</label>
                                                            <?=form_dropdown('repeat_end[]', time_options(), '');?>
                                                        </div>
                                                        <div>
                                                            <a class="btn-certification add-schedule-block">
                                                              <span class="fa fa-plus"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="date-choose">
                                                    <p>What is the service period required?</p>
                                                        <label>Date</label>
                                                        <input type="text" name="repeat_from" class="datepicker-service-period" placeholder="DD/MM/YYYY">
                                                        <label>To</label>
                                                        <input type="text" name="repeat_to" class="datepicker-service-period" placeholder="DD/MM/YYYY" >
                                                    </div>
                                                </div>
                                            </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel-3 -->
                            <div class="panel panel-default">
                                <!-- Header-panel-3 -->
                                <div class="panel-heading">
                                    <h4 class="panel-title ">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                                           class="accordion-toggle collapsed">Type of Service</a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <!-- Content-panel-3 -->
                                    <div class="panel-body">
                                       
                                        <div class="err err_skill"></div>
                                        <ul class="clearfix update-profile-care visit-profile-care">
                                            <?foreach($this->common->services_and_skills() as $service):?>
                                                <li id="serviceli-<?=$service->id?>">
                                                    <input type="checkbox" name="service[]" value="<?=$service->id?>"/>
                                                    <div>
                                                        <img src="assets/images/<?=$service->icon?>" alt="<?=$service->service?>">
                                                        <div><?=$service->service?></div>
                                                    </div>

                                                    <div class="visit-description" id="serviceskill-<?=$service->id?>" data-service="<?=$service->id?>">
                                                        <h4><?=$service->service?></h4>
                                                        <p><?=$service->description?></p>
                                                        <div class="clearfix"></div>
                                                        <fieldset>
                                                            <ul>
                                                                <?foreach($service->skills as $skill):?>
                                                                <li>
                                                                    <label>
                                                                        <?=form_checkbox('skill[]', $skill->id, in_array($skill->id, $case->skills));?>
                                                                        <span></span> 
                                                                        <?=$skill->skill?>
                                                                    </label>
                                                                </li>
                                                                <?endforeach?>
                                                            </ul>
                                                        </fieldset>
                                                    </div>
                                                </li>                                               
                                            <?endforeach?>   
                                        </ul>
                                                                                                                         

                                        <div class="instruction">
                                            <label>Special Instruction</label>
                                            <textarea name="instructions"  cols="30"  rows="10"></textarea>
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <button class="btn-main btn-next">Next</button>
                </div>
                <input  type="hidden"  name="case_id" value="<?=$case->id?>" />
            <?=form_close()?>
        </div>
    </div>
</section>
