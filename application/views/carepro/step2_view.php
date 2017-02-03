<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <a href="<?=care_url("wizard/")?>">
                    <span class="fa fa-user" aria-hidden="true"></span>
                    <span>Personal Particulars</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="javascript:void(0);">
                    <span class="fa fa-wrench" aria-hidden="true"></span>
                    <span>Skills & Qualifications</span>
                    </a>
                </li>
                <li>
                    <span class="fa fa-user" aria-hidden="true"></span>
                    <span>Background Check</span>
                </li>
                <li>
                    <span class="fa fa-lock" aria-hidden="true"></span>
                    <span>Submit Documents</span>
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
            <div class="title-form-personal">It is necessary for Homage to understand your skillset so that we can match
                you with the seniors based on their needs.
            </div>
            <div id="message"></div>
            <?=form_open(care_url("wizard/save_step2"),'class="about-info personal" onsubmit="return SendForm(this)"')?>
                <p>What kind of caregiving training / education do you have?</p>
                <span class="remark">*Indicate NA if you have no formal caregiving training / education</span>
                <div class="err err_training"></div>
                <ul class="check-question clearfix">
                <?php foreach(trainings_array() as $training):?>
                <li>   
                    <label>
                        <?=form_checkbox('training[]', $training, in_array($training, $user->trainings));?>
                        <span></span> <?=$training?>
                    </label>
                </li>    
                <?php endforeach;?>
                </ul>

                <ul class="certifications title-h clearfix">
                  <li>
                    <label for="certification1">Please specify the certifications that you have obtained:</label>
                  </li>
                  <li>
                    <label for="cert_from1">From</label>
                  </li>
                  <li>
                    <label for="cert_till1">Till</label>
                  </li>
                </ul>

                <span class="certification"></span>
                <?foreach($user->certificates as $certificate):?>
                    <ul class="certifications clearfix">
                        <li>                          
                          <input type="text" name="certification[]" value="<?=$certificate->certificate?>" >
                        </li>
                        <li>
                          <input class="datetimepicker-h" type="text"  name="cert_from[]" value="<?=hdate($certificate->certified_on)?>" placeholder="DD/MM/YY"/>
                        </li>
                        <li>
                          <input class="datetimepicker-h" type="text" name="cert_till[]" value="<?=hdate($certificate->expiry)?>" placeholder="DD/MM/YY"/>
                        </li>                    
                    </ul>
                <?endforeach?>
                 <ul class="certifications clearfix">
                    <li>
                      <a class="btn-certification"><span class="fa fa-plus"></span></a>
                      <input type="text" name="certification[]" >
                    </li>
                    <li>
                      <input class="standard_date" type="text"  name="cert_from[]" placeholder="DD/MM/YY"/>
                    </li>
                    <li>
                      <input class="standard_date" type="text" name="cert_till[]" placeholder="DD/MM/YY"/>
                    </li>
                </ul>


                <p>Kindly indicate your experience taking care of patient(s) with the following
                    conditions/artificial devices</p>
                <div class="err err_experience"></div>

                 <div class="check-question clearfix" id="experience">
                    <?foreach(experiences_array() as $key => $experience):?>
                        <div class="col-md-4 col-sm-6">
                            <label>
                                <?=form_checkbox('experience[]', $experience, in_array($experience, $user->experiences));?>
                                <span></span> <?=$experience?>
                            </label>
                        </div>
                    <?endforeach?>                    
                </div>
                <br/>
              
                <p>Please provide a brief summary of your experience:</p>
                <textarea name="experience_summary"  rows="10" class="form-control"><?=$user->experience_summary?></textarea>
                <p>How many years of caregiving experience do you have?</p>
                <div class="err err_experience_years"></div>
                <ul class="check-question clearfix">
                    <?foreach(experience_years_array() as $value):?>
                        <li>
                            <label>
                                <?=form_radio('experience_years', $value, $user->experience_years == $value)?>
                                <span></span>
                                <?=$value?>                          
                            </label>
                        </li>
                    <?endforeach?>
                </ul>

                <p>Kindly indicate the skills/experience(s) you have:</p>
                
                <? foreach($this->common->services_and_skills() as $services):?>   
                    <ul class="check-question clearfix" id="activities">
                        <b><?=$services->service?></b><br>
                            <?foreach($services->skills as $skill):?>
                            <li>
                                <label>
                                <?=form_checkbox('skill[]', $skill->id, in_array($skill->id, $user->skills));?>
                                <span></span> <?=$skill->skill?>
                                </label>
                            </li>
                            <?endforeach?>
                    </ul>
                    <?endforeach?>
                
                <div class="clearfix">
                    <!-- <button class="btn-main btn-back">Back</button> -->
                    <button class="btn-main btn-next">Next</button>
                </div>
            <?=form_close()?>
        </div>
    </div>
</section>

