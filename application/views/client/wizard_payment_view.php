
<section class="container wizard-content payment-record payment">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <a href="javascript:void(0)">
                    <span class="fa fa-clock-o"></span>
                    <span>Schedule Visit</span>
                    </a>
                </li>
                <li class="selected">
                    <span class="fa fa-lock"></span>
                    <span>Payment Matters</span>
                </li>
                <li>
                    <span class="fa fa-user-plus"></span>
                    <span>Upload Picture</span>
                </li>
            </ul>
            <h2>WE ARE ALMOST READY.</h2>
            <h3>Payment Matters</h3>
            <label class="credit-card">
                <input type="radio" name="gender" value="" checked><span></span> Credit Card
            </label>

            <form action="#" class="about-info bank-details">
                <fieldset>
                    <ul>
                        <li>
                            <label for="full-name">Full Name</label>
                            <input type="text" name="full-name" id="full-name" placeholder="JANE DOE">
                        </li>
                        <li>
                            <label for="card-number">Card Number</label>
                            <input type="text" name="card-number" id="card-number" placeholder="5463 7123 1111 0000">
                        </li>
                        <li class="expiry-date">
                            <label>Expiry Date</label>
                            <select name="date" id="date">
                                <option value="0" selected>1</option>
                                <option value="1" selected>2</option>
                            </select>
                            <span>-</span>
                            <select name="month" id="month">
                                <option value="0" selected>1</option>
                                <option value="1">2</option>
                                <option value="2">3</option>
                                <option value="3">4</option>
                                <option value="4">5</option>
                            </select>
                            <span>-</span>
                            <select name="year" id="year">
                                <option value="0" selected>2020</option>
                                <option value="1">2021</option>
                                <option value="2">3</option>
                                <option value="3">4</option>
                                <option value="4">5</option>
                            </select>
                        </li>
                        <li class="cvc">
                            <label for="cvc">CVC</label>
                            <input type="text" name="cvc" id="cvc" placeholder="123">
                            <a class="what_cvc btn" href="javascript:void(0)" id="popoverData" data-content="Popover with data-trigger" rel="popover" data-placement="top" data-trigger="hover">What Is CVC</a>
                        </li>
                    </ul>
                </fieldset>
            </form>
            <div class="clearfix btn-margin">
                <a href="<?=client_url("wizard/schedule_visit/")?>" class="btn-main btn-back">Back</a>
                <a href="<?=client_url("wizard/upload_picture/$case_id")?>" class="btn-main btn-next">Next</a>
            </div>
        </div>
    </div>
</section>
