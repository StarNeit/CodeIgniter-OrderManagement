<section class="container wizard-content update-password">
    <div class="row">
        <div class="col-xs-12">
            <ul class="profile-menu clearfix">
                <li><a href="<?=care_url("profile/edit")?>">Update Profile</a></li>
                <li class="active"><a href="<?=care_url("profile/account")?>">Account Settings</a></li>
            </ul>

            <h2>MANAGE ACCOUNT</h2>

            <h3>Update Password</h3>

            <?=form_open(care_url("profile/save_account"), 'onsubmit="return SendForm(this)" class="about-info"')?>

          <div class="col-sm-12">
            <div id="message"><?=show_message()?></div>
          </div>

                <fieldset>
                    <ul class="pass-info">
                        <li>
                            <label for="old_password"> Old Password</label>
                            <input name="old_password" id="old_password" type="password">
                        </li>
                        <li>
                            <label for="new_password">New Password</label>
                            <input name="new_password" id="new_password" type="password">
                        </li>
                        <li>
                            <label for="confirm_password">Confirm Password</label>
                            <input name="confirm_password" id="confirm_password" type="password">
                        </li>
                    </ul>
                </fieldset>


              <div class="col-xs-12 clearfix">
              <button class="btn-main btn-next">Update</button>
              </div>
               <?=form_close()?>
            </div>
        </div>
    </div>
</section>
