
<section class="container wizard-content update-password">
    <div class="row">
        <div class="col-xs-12">
            <ul class="profile-menu clearfix">
                <li><a href="<?=client_url("account/particulars")?>">Update Particulars</a></li>
                <li class="active"><a href="javascript:void(0);">Account Settings</a></li>
            </ul>

            <h2>MANAGE ACCOUNT</h2>

            <h3>Update Password</h3>

            <?=form_open(client_url("account/save_account"), 'onsubmit="return SendForm(this)" class="about-info"')?>
            <div class="col-sm-12">
                <div id="message"><?=show_message()?></div>
            </div>
            
                <fieldset>
                    <ul class="pass-info">
                        <li>
                            <label for="old_password"> Old Password</label>
                            <input type="password" name="old_password" id="old_password">
                        </li>
                        <li>
                            <label for="new-password">New Password</label>
                            <input type="password" name="new_password" id="new_password">
                        </li>
                        <li>
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password">
                        </li>
                    </ul>
                </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 clearfix">
            <button class="btn-main btn-next">Update</button>
        </div>
    </div>
    <?=form_close()?>
</section>
