<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <span class="fa fa-user"></span>
                    <span>About Recipient</span>
                </li>
                <li>
                    <span class="fa fa-th-list"></span>
                    <span>Care Needs</span>
                </li>
                <li>
                    <span class="fa fa-clock-o"></span>
                    <span>First Care</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2>Who needs care?</h2>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-6">
            <a href="javascript:;" class="btn-main btn-care-inverse">Loved one</a>
        </div>
        <div class="col-xs-12 col-sm-6">
            <a href="<?=client_url("wizard/step1b")?>" class="btn-main btn-care">Myself</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <form action="#" class="relationship">
                <label for="Relationship">Relationship</label>
                <select name="Relationship" id="Relationship">
                    <option value="0" selected>Father</option>
                    <option value="1">Mother</option>
                    <option value="2">Other</option>
                </select>
            </form>
            <div class="title-form">Tell us more</div>
            <form action="#" class="about-info about-recipient">
                <ul>
                    <li>
                        <label for="Salutation">Salutation</label>
                        <select name="Salutation" id="Salutation">
                            <option value="0" selected>Ms</option>
                            <option value="1">Mr</option>
                        </select>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="name">First Name</label>
                                <input type="text" value="" placeholder="" name="name" id="name">
                            </li>
                            <li>
                                <label for="surname">Last Name</label>
                                <input type="text" value="" placeholder="" name="surname" id="surname">
                            </li>
                        </ul>
                    </li>
                    <li>
                        <label>Date Of Birth</label>
                        <ul class="clearfix birthday">
                            <li>
                                <select name="date-of-birth" id="select1">
                                    <option value="0" selected>01</option>
                                    <option value="1">02</option>
                                    <option value="2">03</option>
                                    <option value="3">04</option>
                                </select>
                            </li>
                            <li>
                                <select name="month-of-birth" id="select2">
                                    <option value="0" selected>01</option>
                                    <option value="1">02</option>
                                    <option value="2">03</option>
                                    <option value="3">04</option>
                                </select>
                            </li>
                            <li>
                                <select name="year-of-birth" id="select3">
                                    <option value="0" selected>1957</option>
                                    <option value="1">1958</option>
                                    <option value="2">1959</option>
                                    <option value="3">1960</option>
                                </select>
                            </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="Religion">Religion</label>
                                <input type="text" value="" placeholder="" name="Religion" id="Religion">
                            </li>
                            <li class="clearfix">
                                <label for="select5">Race</label>
                                <select name="year-of-birth" id="select5">
                                    <option value="0" selected>Chinese</option>
                                    <option value="1">1</option>
                                </select>
                            </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="select4">Gender</label>
                                <select name="year-of-birth" id="select4">
                                    <option value="0" selected>Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </li>
                            <li>
                                <label for="weight">Weight</label>
                                <input type="text" value="" placeholder="KG" name="weight" id="weight">
                            </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="number">NRIC No.</label>
                                <input type="text" name="number" id="number" value="" placeholder="S1234567A">
                            </li>
                            <li>
                                <label for="height">Height</label>
                                <input type="text" value="" placeholder="CM" name="height" id="height">
                            </li>
                        </ul>
                    </li>
                    <li class="check-list_wrap">
                        <label>Do you have any language requests?</label>
                        <ul class="check-list clearfix">
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span> English
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span> Mandarin
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span> Malay
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span> Tamil
                                </label>
                            </li>
                            
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span>Hokkien
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span> Teochew
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span> Cantonese
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span> Hakka
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span> Hainanese
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="language" value=""/><span></span> Others
                                </label>
                            </li>
                        </ul>
                    </li>
                    <li class="medical">
                        <label>Diagnosis:</label>
                        <textarea name="medical-condition" id="medical-condition" cols="30" rows="10"></textarea>
                    </li>
                    <li class="medical">
                        <label>Medical Condition:</label>
                        <textarea name="medical-condition" id="medical-condition" cols="30" rows="10"></textarea>
                    </li>
                </ul>
            </form>
            <div class="clearfix">
                <a href="2.html" class="btn-main btn-next">Next</a>
            </div>
        </div>
    </div>
</section>