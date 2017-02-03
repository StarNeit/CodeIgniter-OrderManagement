
<section class="container wizard-content care-needs">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <span class="fa fa-user"></span>
                    <span>About Recipient</span>
                </li>
                <li class="selected">
                    <span class="fa fa-th-list"></span>
                    <span>Care Needs</span>
                </li>
                <li class="selected">
                    <span class="fa fa-clock-o"></span>
                    <span>First Care</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?=form_open(client_url('wizard/save_step3'), 'class="care-needs-form" onsubmit="return SendForm(this)"')?>


                <div class="about-info personal">
                    <h2>WHEN DO YOU NEED CARE?</h2>

                    <div id="message"></div>
                    <h3>Let us know when you need the care to start</h3>

                    <ul>
                        <li class="half">
                            <ul>
                                <li class="date-choose">
                                    <input type="text" class="standard_date" name="service_from" value="<?=hdate($case->service_from)?>" />
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="clearfix">
                    <input type="hidden" name="id" value="<?=$case->id?>" />
                    <a href="<?=client_url("wizard/step2")?>" class="btn-main btn-back">Back</a>
                    <button class="btn-main btn-next">Next</button>
                </div>
            <?=form_close()?>
        </div>
    </div>
</section>




<div id="success-modal" class="modal fade simple-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div>You have successfully added a care recipient. Homage will
                    contact you for a care assessment within 1 working day
                </div>
                <a href="<?=client_url("care_recipients")?>" class="btn btn-enter btn-modal-inner">Done</a>
            </div>
        </div>
    </div>
</div>

