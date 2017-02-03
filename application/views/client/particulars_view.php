<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <ul class="profile-menu clearfix">
                <li class="active"><a href="<?=client_url("account/particulars")?>">Update Particulars</a></li>
                <li><a href="<?=client_url("account")?>">Account Settings</a></li>
            </ul>

            <h2>MY PARTICULARS</h2>

            <div id="message"><?=show_message()?></div>
           
            <?=form_open( client_url("account/particulars_update"), 'onsubmit="return SendForm(this)" class="about-info personal" id="particulars"')?>

                <ul class="clearfix">
                    <li>
                        <label for="name">First Name</label>
                        <input type="text" name="first_name" value="<?=$user->first_name?>">
                    </li>
                    <li>
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last_name" value="<?=$user->last_name?>">
                    </li>
                  
                    <li>
                        <label for="email">Email</label>
                        <input type="text" name="email" value="<?=$user->email?>">
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="contact_no">Contact No.</label>
                                 <input type="text" name="contact_home" value="<?=$user->contact_home?>" placeholder="HOME">
                            </li>
                            <li>
                                 <input type="text" name="contact_mobile" value="<?=$user->contact_mobile?>" placeholder="HP">
                            </li>
                        </ul>
                    </li>

                    <li class="half">
                        <ul>
                            <li>
                                <label for="postal">Postal Code</label>
                                 <input type="text" name="postal_code" value="<?=$user->postal_code?>" id="postal_code" placeholder="478202">
                            </li>
                            <li>
                                <label for="unit">Unit No.</label>
                                <input type="text" name="unit" value="<?=$user->unit?>" id="unit">
                            </li>
                        </ul>
                    </li>
                    <li class="half">
                        <ul>
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
                </ul>

                <div class="clearfix">
                    <button class="btn-main btn-enter pull-right">Update</button>
                </div>
           <?=form_close()?>
        </div>
    </div>
</section>
