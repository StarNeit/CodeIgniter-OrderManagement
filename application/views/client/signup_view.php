<section class="container wizard-content new-account-reg">
    <div class="row">
        <div class="col-xs-12">
            <h2>New Account registration</h2>

            <p>Please fill in your personal particulars below.</p>
            <div id="message"></div>
            <?=form_open("client/signup/submit", 'onsubmit="return SendForm(this)" class="about-info account-reg"')?>
                <fieldset>
                    <ul>
                        <li>
                            <label for="salutation">Salutation</label>
                            <?=form_dropdown('salutation', salutation_options(), $user->salutation);?>
                        </li>
                        <li>
                            <label for="first-name">First Name</label>
                            <input type="text"  name="first_name" value="<?=$user->first_name?>" placeholder=""/>
                        </li>
                        <li>
                            <label for="last-name">Last Name</label>
                           <input type="text"  name="last_name" value="<?=$user->last_name?>" placeholder=""/>
                        </li>
                        <li>
                            <label for="email">Email</label>
                            <input type="text"  name="email" value="<?=$user->email?>" placeholder=""/>
                        </li>
                        <li class="half">
                            <ul>
                                <li>
                                    <label for="contact_home">Contact No.</label>
                                    <input type="text" name="contact_home" id="contact_home" value="<?=$user->contact_home?>" placeholder="HOME">
                                </li>
                                <li>
                                    <input type="text" name="contact_mobile" value="<?=$user->contact_mobile?>" id="contact_mobile" placeholder="HP">
                                </li>
                                <li>
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" name="postal_code" value="<?=$user->postal_code?>" id="postal_code" placeholder="478202">
                                </li>
                                <li>
                                    <label for="unit">Unit No.</label>
                                    <input type="text" name="unit" value="<?=$user->unit?>" id="unit" placeholder="#01-01">
                                </li>
                                <li>
                                    <label for="block">Block No.</label>
                                    <input type="text" name="block" value="<?=$user->block?>" id="block"  placeholder="202">
                                </li>
                                <li>
                                    <label for="street">Street</label>
                                    <input type="text" name="street" value="<?=$user->street?>" id="street" placeholder="Choa Chu Kang Ave 10">
                                </li>
                            </ul>
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="">
                        </li>
                        <li>
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="password2" id="confirm-password" placeholder="">
                        </li>
                        <li class="account-reg-how">
                        <!--<li>-->
                            <label for="answer-how">How did you know about Homage?</label>
                            <?=form_dropdown('know_how', know_how_options(), $user->know_how)?>
                        </li>
                    </ul>
                    <div>
                        <label>
                            <input type="checkbox" name="agreement" value="1" id="agreeterm"><span></span> 
                            I have read and agree to Homage’s
                                <a href="javascript:void(0)" id="modal-nda" style="color:#158fa6">Terms & Conditions</a>
                        </label>
                    </div>
                </fieldset>
           
                <div class="clearfix">
                    <button class="btn-main btn-next" >Create</button>
                </div>
            <?=form_close()?>
        </div>
    </div>
</section>


<div id="myModalBox-nda" class="modal fade user-agreements-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="#">
                                <h2>Non-disclosure Agreement</h2>

                                <div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                        Curabitur varius
                                        lectus
                                        eu libero pretium consectetur. In eu neque libero. Praesent rhoncus a justo ac
                                        finibus. Nam eget
                                        imperdiet justo. Donec eget felis id massa malesuada hendrerit eu nec nibh.
                                        Donec cursus augue in
                                        orci
                                        varius pharetra. Vivamus lacinia malesuada tellus.Vivamus lacinia malesuada
                                        tellus. Morbi et mattis
                                        dui,
                                        nec ultricies lacus. Sed est tortor, laoreet id aliquam lobortis, maximus nec
                                        neque. Maecenas congue
                                        sem
                                        et porta con sectetur.</p>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                        Curabitur varius
                                        lectus
                                        eu libero pretium consectetur. In eu neque libero. Praesent rhoncus a justo ac
                                        finibus. Nam eget
                                        imperdiet justo. Donec eget felis id massa malesuada hendrerit eu nec nibh.
                                        Donec cursus augue in
                                        orci
                                        varius pharetra. Vivamus lacinia malesuada tellus.Vivamus lacinia malesuada
                                        tellus. Morbi et mattis
                                        dui,
                                        nec ultricies lacus. Sed est tortor, laoreet id aliquam lobortis, maximus nec
                                        neque. Maecenas congue
                                        sem
                                        et porta con sectetur. </p>
                                </div>
                                <div>
                                    <br/><br/><br/>
                                </div>

                                <h2>Non-disclosure Agreement</h2>

                                <div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                        Curabitur varius
                                        lectus
                                        eu libero pretium consectetur. In eu neque libero. Praesent rhoncus a justo ac
                                        finibus. Nam eget
                                        imperdiet justo. Donec eget felis id massa malesuada hendrerit eu nec nibh.
                                        Donec cursus augue in
                                        orci
                                        varius pharetra. Vivamus lacinia malesuada tellus.Vivamus lacinia malesuada
                                        tellus. Morbi et mattis
                                        dui,
                                        nec ultricies lacus. Sed est tortor, laoreet id aliquam lobortis, maximus nec
                                        neque. Maecenas congue
                                        sem
                                        et porta con sectetur.</p>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                        Curabitur varius
                                        lectus
                                        eu libero pretium consectetur. In eu neque libero. Praesent rhoncus a justo ac
                                        finibus. Nam eget
                                        imperdiet justo. Donec eget felis id massa malesuada hendrerit eu nec nibh.
                                        Donec cursus augue in
                                        orci
                                        varius pharetra. Vivamus lacinia malesuada tellus.Vivamus lacinia malesuada
                                        tellus. Morbi et mattis
                                        dui,
                                        nec ultricies lacus. Sed est tortor, laoreet id aliquam lobortis, maximus nec
                                        neque. Maecenas congue
                                        sem
                                        et porta con sectetur. </p>
                                </div>
                                <div>
                                    <label>
                                        <input type="checkbox" name="agreement" id="checkterm" onclick="checkTerm()"><span></span> I have read and agree with
                                        Homage’s non-disclosure
                                        agreement.
                                    </label>
                                </div>

                                <div>
                                    <button  type="button" class="btn btn-default btn-modal-inner" data-dismiss="modal" aria-label="Close">
                                        CONFIRM
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------------Modal-window----------------->

<div id="myModalBox-nda" class="modal fade user-agreements-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="#">
                                <h2>Non-disclosure Agreement</h2>

                                <div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                        Curabitur varius
                                        lectus
                                        eu libero pretium consectetur. In eu neque libero. Praesent rhoncus a justo ac
                                        finibus. Nam eget
                                        imperdiet justo. Donec eget felis id massa malesuada hendrerit eu nec nibh.
                                        Donec cursus augue in
                                        orci
                                        varius pharetra. Vivamus lacinia malesuada tellus.Vivamus lacinia malesuada
                                        tellus. Morbi et mattis
                                        dui,
                                        nec ultricies lacus. Sed est tortor, laoreet id aliquam lobortis, maximus nec
                                        neque. Maecenas congue
                                        sem
                                        et porta con sectetur.</p>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                        Curabitur varius
                                        lectus
                                        eu libero pretium consectetur. In eu neque libero. Praesent rhoncus a justo ac
                                        finibus. Nam eget
                                        imperdiet justo. Donec eget felis id massa malesuada hendrerit eu nec nibh.
                                        Donec cursus augue in
                                        orci
                                        varius pharetra. Vivamus lacinia malesuada tellus.Vivamus lacinia malesuada
                                        tellus. Morbi et mattis
                                        dui,
                                        nec ultricies lacus. Sed est tortor, laoreet id aliquam lobortis, maximus nec
                                        neque. Maecenas congue
                                        sem
                                        et porta con sectetur. </p>
                                </div>
                                <div>
                                    <br/><br/><br/>
                                </div>

                                <h2>Non-disclosure Agreement</h2>

                                <div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                        Curabitur varius
                                        lectus
                                        eu libero pretium consectetur. In eu neque libero. Praesent rhoncus a justo ac
                                        finibus. Nam eget
                                        imperdiet justo. Donec eget felis id massa malesuada hendrerit eu nec nibh.
                                        Donec cursus augue in
                                        orci
                                        varius pharetra. Vivamus lacinia malesuada tellus.Vivamus lacinia malesuada
                                        tellus. Morbi et mattis
                                        dui,
                                        nec ultricies lacus. Sed est tortor, laoreet id aliquam lobortis, maximus nec
                                        neque. Maecenas congue
                                        sem
                                        et porta con sectetur.</p>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                        Curabitur varius
                                        lectus
                                        eu libero pretium consectetur. In eu neque libero. Praesent rhoncus a justo ac
                                        finibus. Nam eget
                                        imperdiet justo. Donec eget felis id massa malesuada hendrerit eu nec nibh.
                                        Donec cursus augue in
                                        orci
                                        varius pharetra. Vivamus lacinia malesuada tellus.Vivamus lacinia malesuada
                                        tellus. Morbi et mattis
                                        dui,
                                        nec ultricies lacus. Sed est tortor, laoreet id aliquam lobortis, maximus nec
                                        neque. Maecenas congue
                                        sem
                                        et porta con sectetur. </p>
                                </div>
                                <div>
                                    <label>
                                        <input type="checkbox" name="agreement" id="checkterm" onclick="checkTerm()"><span></span> I have read and agree with
                                        Homage’s non-disclosure
                                        agreement.
                                    </label>
                                </div>

                                <div>
                                    <button  type="button" class="btn btn-default btn-modal-inner" data-dismiss="modal" aria-label="Close">
                                        CONFIRM
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        checkTerm();
    });
    
    function checkTerm(){
        if ($('#checkterm').prop('checked')==true)
            $('#agreeterm').prop('checked', true);
        else
            $('#agreeterm').prop('checked', false);
        
    }
</script>
