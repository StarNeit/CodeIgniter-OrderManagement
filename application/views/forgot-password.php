<section class="container wizard-content reset-forgot-password">
    <div class="row">
        <div class="col-xs-12">
            <h2>Forgot password</h2>

            <p>
                Please enter the email address registered with Homage.<br>
                An email containing the reset password link will be sent to you shortly.
            </p>

            <!-- <form action="#" > -->
            <?=form_open("login/reset", 'class="about-info reset-pass-form forgot-password"')?>
            <div id="message"><?=show_message()?></div>
                <fieldset>
                    <ul>
                        <li>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </li>
                    </ul>
                </fieldset>
                <button class="btn-main btn-enter">Confirm</button>
            </form>
        </div>
    </div>
</section><!--/#main-slider-->