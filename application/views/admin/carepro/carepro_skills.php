<div class="page-content">
  
   <? $this->load->view("admin/carepro/carepro_breadcrumbs");?>

    <div class="page-body">
     
        <? $this->load->view('admin/carepro/carepro_tabs')?>
       
        <div class="tabbable">
            

            <div class="tab-content radius-bordered">
                <div class="tab-pane in active">

                    <?=form_open(admin_url("carepro/save_skills"), 'onsubmit="return SendForm(this)" class="form-horizontal"')?>                    
                            
                            <div id="message"><?=show_message()?></div>
                            
                            <div class="form-title">
                                Certification Information
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12 skills">
                                        What kind of caregiving training/experience do you have?<br/>
                                        <?foreach(trainings_array() as $training):?>   
                                        <div class="checkbox">
                                            <label>
                                                <?=form_checkbox('training[]', $training, in_array($training, $user->trainings), 'class="colored-blue"');?>                                                           
                                                <span class="text"><?=$training?></span>
                                            </label>
                                        </div>
                                        <?endforeach?> 
                                    </div>
                                </div>
                            </div>
                            <br/>

                            <div class="form-title">
                                Caregiving Experience
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12 experience">
                                        Kindly indicate your experience taking care of patient(s) with the following conditions/artificial devices:<br/>
                                        <?foreach(experiences_array() as $experience):?>   
                                        <div class="checkbox">
                                            <label>
                                                <?=form_checkbox('experience[]', $experience, in_array($experience, $user->experiences), 'class="colored-blue"');?>                                                           
                                                <span class="text"><?=$experience?></span>
                                            </label>
                                        </div>
                                        <?endforeach?> 
                                    </div>
                                </div>
                            </div>
                            <br/>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        Please provide a brief summary of your experience:<br/><br/>
                                        <textarea rows="5" cols="5" class="form-control" name="experience_summary"><?=$user->experience_summary?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12 care-services">
                                        How many years of caregiving experience do you have?<br/>
                                        <?foreach(experience_years_array() as $value):?>
                                        <div class="checkbox">
                                            <label>
                                                <?=form_radio("experience_years", $value, $user->experience_years == $value, 'class="colored-blue"')?>
                                                <span class="text"><?=$value?></span>
                                            </label>
                                        </div>
                                        <?endforeach?>

                                    </div>
                                </div>
                            </div>
                            <br/>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12 activities">
                                        Kindly indicate the skills/experience(s) you have:<br>
                                        
                                        <? foreach($this->common->services_and_skills() as $services):?>   
                                        <br>
                                        <b><?=$services->service?></b><br>
                                        <?foreach($services->skills as $skill):?>
                                            <div class="checkbox">
                                                <label>
                                                    <?=form_checkbox('skill[]', $skill->id, in_array($skill->id, $user->skills), 'class="colored-blue"');?>                  
                                                    <span class="text"><?=$skill->skill?></span>
                                                </label>
                                            </div>
                                        <?endforeach?>
                                        <br>
                                        <?endforeach?> 
                                    </div>
                                </div>
                            </div>

                            <div class="form-title">
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6 pull-right">
                                    <input type="hidden" name="user_id" value="<?=$user->user_id?>" />
                                    <input class="btn btn-palegreen pull-right" type="submit" value="Save" />
                                </div>
                            </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>       

    </div>
    <br/><br/>
    <!--/tabs-->
</div>