<div class="page-content">
    <? $this->load->view("admin/carepro/carepro_breadcrumbs");?>
    <div class="page-body">
        <!-- Tabs -->
        
        <div class="tabbable">
            <? $this->load->view("admin/carepro/carepro_tabs")?>

            <div class="tab-content radius-bordered">
                <div class="tab-pane in active">                    
                    <?=form_open(admin_url("carepro/save_background"), 'onsubmit="return SendForm(this)" class="form-horizontal"')?>

                        <div id="message"><?=show_message()?></div>

                        <div class="form-title">
                            Criminal Record Check
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12 skills">
                                    Have you ever been convicted of a crime in and / or outside Singapore?<br/>
                                    <div class="checkbox">
                                        <label>
                                            <?=form_radio("criminal_record", 1, $user->criminal_record==1, 'class="colored-blue"')?>
                                            <span class="text">Yes</span>
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <?=form_radio("criminal_record", 0, $user->criminal_record==0, 'class="colored-blue"')?>
                                            <span class="text">No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    If your answer is Yes, please give details of the nature and circumstances of the crime(s), the date and the location in which each crime occurred.<br/><br/>
                                    <textarea rows="5" cols="5" name="criminal_detail" class="form-control"><?=$user->criminal_detail?></textarea>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="form-title">
                            Contact Reference No.1  
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">Name: </label>
                                        <input type="text" class="form-control" name="ref_name" value="<?=$user->ref_name?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="cardInput">Relationship: </label>
                                        <input type="text" class="form-control" name="ref_relationship" value="<?=$user->ref_relationship?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="cvcInput">Contact Number: </label>
                                        <input type="text" class="form-control" name="ref_contact" value="<?=$user->ref_contact?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="cvcInput">Email Address: </label>
                                        <input type="text" class="form-control" name="ref_email" value="<?=$user->ref_email?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-title">
                            Contact Reference No.2  
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nameInput">Name: </label>
                                        <input type="text" class="form-control" name="sec_ref_name" value="<?=$user->sec_ref_name?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="cardInput">Relationship: </label>
                                        <input type="text" class="form-control" name="sec_ref_relationship" value="<?=$user->sec_ref_relationship?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="cvcInput">Contact Number: </label>
                                        <input type="text" class="form-control" name="sec_ref_contact" value="<?=$user->sec_ref_contact?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="cvcInput">Email Address: </label>
                                        <input type="text" class="form-control" name="sec_ref_email" value="<?=$user->sec_ref_email?>"/>
                                    </div>
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
        <br/><br/>
        <!--/tabs-->
    </div>
</div>