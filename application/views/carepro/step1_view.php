<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <a href="javascript:void(0);">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <span>Personal Particulars</span>
                    </a>
                </li>
                <li>
                    <span class="fa fa-wrench" aria-hidden="true"></span>
                    <span>Skills & Qualifications</span>
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
            <div class="title-form-personal">Please fill in your personal particulars below.</div>
            <div id="message"></div>
            <?=form_open(care_url('wizard/save_step1'), 'class="about-info personal" onsubmit="return SendForm(this)"')?>
                <ul class="clearfix">
                    <li>
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" placeholder="">
                    </li>
                    <li>
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" placeholder="">
                    </li>
                    <li class="clearfix nationality">
                        <label for="Nationality">Nationality</label>
                        <?=form_dropdown('nationality-select', nationality_options(), '')?><br/>
                    </li>
                    <li class="hide nationality-hide">
                        <label class="hide"></label>
                        <input value="" name="nationality" id="nationality" class="hide">
                    </li>
                    <li>
                        <label for="national_id">NRIC/Passport</label>
                        <input type="text" name="national_id" id="national_id" placeholder="S1394942Z">
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label>Date Of Birth</label>
                                <input type="text" name="dob" class="datepicker">
                            </li>
                            <li>
                                <label for="gender">Gender</label>
                                <?=form_dropdown('gender', gender_options());?>
                            </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="weight">Weight</label>
                                <input type="text" name="weight" id="weight" placeholder="KG">
                            </li>
                            <li>
                                <label for="height">Height</label>
                                <input type="text" name="height" id="height" placeholder="CM">
                            </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
                            <li class="religion">
                                <label for="religion">Religion</label>
                               <?=form_dropdown('religion-select', religion_options());?>
                            </li>
                            <li class="race">
                                <label for="race">Race</label>
                               <?=form_dropdown('race-select', race_options());?>
                            </li>
                            <li class="hide religion-hide">
                        <label class="hide"></label>
                        <input value="" name="religion" id="religion" class="hide">
                    </li>
                    <li class="hide race-hide">
                    </li>
                    <li class="hide race-hide">
                        <label class="hide">Please Specify</label>
                        <input value="" name="race" id="race" class="hide" placeholder='Other Race'>
                    </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="contact_home">Contact No.</label>
                                <input type="text" name="contact_home" id="contact_home" placeholder="HOME">
                            </li>
                            <li>
                                <input type="text" name="contact_mobile" id="hp" placeholder="HP">
                            </li>
                        </ul>
                    </li>
                    <li>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="">
                    </li>
                    <li>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="">
                    </li>
                    <li>
                        <label for="password2">Re-type Password </label>
                        <input type="password" name="password2" id="password2" placeholder="">
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="postal_code">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code" placeholder="478202">
                            </li>
                            <li>
                                <label for="unit">Unit No.</label>
                                <input type="text" name="unit" id="unit" placeholder="#01-01">
                            </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="block">Block No.</label>
                                <input type="text" name="block" id="block" placeholder="202">
                            </li>
                            <li>
                                <label for="street">Street</label>
                                <input type="text" name="street" id="street" placeholder="Choa Chu Kang Ave 10">
                            </li>
                        </ul>
                    </li>
                </ul>
                <p>Language(s) that you are able to speak fluently</p>
                  <span class="err err_language"></span>
                <ul class="check-list clearfix">
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="English"/><span></span> English
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="Mandarin"/><span></span> Mandarin
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="Malay"/><span></span> Malay
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="Tamil"/><span></span> Tamil
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="Hokkien"/><span></span> Hokkien
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="Teochew"/><span></span> Teochew
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="Cantonese"/><span></span> Cantonese
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="Hakka"/><span></span> Hakka
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="Hainanese"/><span></span> Hainanese
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="language[]" value="Others"/><span></span> Others
                        </label>
                    </li>
                </ul>
                <p>Are you suffering from any medical conditions, including neck and back problem?</p>
                <span class="err err_medical_conditions"></span>
                <ul class="check-question clearfix">
                    <li>
                        <label>
                            <input type="radio" name="medical_conditions" value="no"/><span></span> No
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="medical_conditions" value=""/><span></span> Yes, please specify :
                        </label>
                        <input type="text" name="specify" value="" id="specify">
                    </li>
                </ul>
                <p>Do you have a smart phone?</p>
                <span class="err err_smart_phone"></span>
                <ul class="check-question clearfix">
                    <li>
                        <label>
                            <input type="radio" name="smart_phone" value="1"/><span></span> No
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="smart_phone" value="0"/><span></span> Yes
                        </label>
                    </li>
                </ul>
                <div class="clearfix">
                    <button class="btn-main btn-next">Next</button>
                </div>
            <?=form_close()?>
        </div>
    </div>
</section>