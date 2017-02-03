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
                    <a href="javascript:void(0)">
                    <span class="fa fa-user" aria-hidden="true"></span>
                    <span>Background Check</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="javascript:void(0)">
                    <span class="fa fa-lock" aria-hidden="true"></span>
                    <span>Submit Documents</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="javascript:void(0);">
                    <span class="fa fa-file-text-o" aria-hidden="true"></span>
                    <span>Information Declaration</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?=form_open(care_url('wizard/save_step5'), 'class="about-info personal" onsubmit="return SendForm(this)"')?>
                <h3 class="title">PERSONAL INFORMATION DECLARATION</h3>

                <p>I hereby declare that all the above information is true and correct to the best of my knowledge and
                    belief and I undertake to inform you of any changes therein, immediately. In case should any of the
                    above information is found to be untrue or misleading or misrepresenting, I am aware that I may be
                    held liable".</p>
                <div id="message"></div>
                <ul class="check-question check-question-one clearfix">
                    <li>
                        <label>
                            <input type="checkbox" name="sign" value="1"><span></span> By checking this box and typing my name
                            below, I am electronically signing my application.
                        </label>
                    </li>
                </ul>
                <ul>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="name">Name</label>
                                <input type="text" value="" placeholder="" name="name" id="name" >
                            </li>
                            <li>
                                <label for="date">Date</label>
                                <input type="text" value="<?=date('d/m/Y')?>" placeholder="DD/MM/YY" name="date" readonly>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix">
                    <!-- <a href="<?=care_url("wizard/step4")?>" class="btn-main btn-back">Back</a> -->
                    <button class="btn-main btn-next">Next</button>
                </div>
            <?=form_close()?>
        </div>
    </div>
</section>


<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-inner">Thank you for your submission. We will
                    contact you if you are shortlisted.</div>
                <div class="modal-status">Status: Application Received</div>
                <a href="<?=site_url("")?>"><button type="button" class="btn btn-default btn-modal-inner">Done</button></a>
            </div>
        </div>
    </div>
</div>
