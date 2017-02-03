<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <a href="javascript:void(0)">
                    <span class="fa fa-user" aria-hidden="true"></span>
                    <span>Personal Particulars</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="javascript:void(0)">
                    <span class="fa fa-wrench" aria-hidden="true"></span>
                    <span>Skills &amp; Qualifications</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="javascript:void(0);">
                    <span class="fa fa-user" aria-hidden="true"></span>
                    <span>Background Check</span>
                    </a>
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
            <div class="title-form-personal">As our seniors can be very vulnerable, it is therefore necessary for
                us to conduct this screening.
            </div>
            <div id="message"></div>
            <?=form_open(care_url("wizard/save_step3"), 'onsubmit="return SendForm(this)" class="about-info personal"')?>
                <h3 class="title">Criminal Record Check</h3>

                <p>If your answer is Yes, please give details of the nature and circumstances of the crime(s), the
                    date and the location in which each crime occurred.</p>
                <ul class="check-question clearfix">
                    <li>
                        <label>
                            <?=form_radio('criminal_record', 0, !$user->criminal_record)?>
                            <span></span> No
                        </label>
                    </li>
                    <li>
                        <label>
                            <?=form_radio('criminal_record', 1, $user->criminal_record)?>
                            <span></span> Yes
                        </label>
                    </li>
                </ul>
                 <div class="err err_criminal_record"></div>
                <p>If your answer is Yes, please give details of the nature and circumstances of the crime(s), the
                    date and the location in which each crime occurred.</p>
                <textarea name="criminal_detail" class="form-control" rows="10"><?=$user->criminal_detail?></textarea>

                <p>If your answer is No, you, hereby declare that you have never been convicted of any
                    criminal offence during your stay in Singapore and other countries.</p>

                <p class="agreement">I understand that an electronic signature has the same legal effect and can be
                    enforced in the
                    same way as written signature. </p>
                <ul class="check-question clearfix">
                    <li>
                        <label>
                            <input type="checkbox" name="confirmation" value="1"><span></span> By checking this box and typing my name
                            below, I am electronically signing my application.
                        </label>
                    </li>
                </ul>
                <div class="err err_confirmation"></div>
                <div class="relationship">
                    <label for="full-name">Full Name</label>
                    <input type="text" name="full_name" id="full-name" value="<?=$user->full_name?>">
                </div>
                <h3 class="title">Contact Reference No. 1 </h3>
                <p>Kindly provide details of 2 of your previous job/character references. We will contact them
                    to verify information, such as your skills and experience.</p>
                <ul id="contact-reference">
                    <li class="half">
                        <ul>
                            <li>
                                <label for="name">Name</label>
                                <input type="text" value="" placeholder="" name="ref_name" value="<?=$user->ref_name?>" id="name">
                            </li>
                            <li>
                                <label for="relationships">Relationships</label>
                                <input type="text" value="" placeholder="" name="ref_relationship"  value="<?=$user->ref_relationship?>" id="relationships">
                            </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="contact-number">Contact Number</label>
                                <input type="text" value="" placeholder="" name="ref_contact" value="<?=$user->ref_contact?>" id="contact-number">
                            </li>
                            <li>
                                <label for="email">Email address</label>
                                <input type="email" value="" placeholder="" name="ref_email" value="<?=$user->ref_email?>" id="email">
                            </li>
                        </ul>
                    </li>
                </ul>

                <h3 class="title">Contact Reference No. 2 </h3>
                <ul id="contact-reference2">
                    <li class="half">
                        <ul>
                            <li>
                                <label for="name2">Name</label>
                                <input type="text" value="" placeholder="" name="sec_ref_name" value="<?=$user->sec_ref_name?>" id="name2">
                            </li>
                            <li>
                                <label for="relationships2">Relationships</label>
                                <input type="text" value="" placeholder="" name="sec_ref_relationship" value="<?=$user->sec_ref_relationship?>" id="relationships2">
                            </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="contact-number">Contact Number</label>
                                <input type="text" value="" placeholder="" name="sec_ref_contact" value="<?=$user->sec_ref_contact?>" id="contact-number">
                            </li>
                            <li>
                                <label for="email">Email address</label>
                                <input type="email" value="" placeholder="" name="sec_ref_email" value="<?=$user->sec_ref_email?>" id="email">
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="clearfix">
                    <!-- <a href="<?=care_url("wizard/step2")?>" class="btn-main btn-back">Back</a> -->
                    <button class="btn-main btn-next">Next</button>
                </div>
            <?=form_close()?>
        </div>
    </div>
</section>

