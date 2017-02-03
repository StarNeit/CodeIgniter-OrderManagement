<div class="login-position">
    <div class="container">
        <div class="login">
                <div class="login-inner">
                    <?=form_open("login/post")?>
                        <div id="message"><?=show_message()?></div>
                        <fieldset>
                            <ul>
                                <li>
                                    <input type="email" name="email" id="email" placeholder="email">
                                </li>
                                <li>
                                    <input type="password" name="password" id="password" placeholder="password">
                                </li>
                            </ul>
                            <div>
                                <input type="submit" value="login">
                            </div>
                        </fieldset>
                    <?=form_close()?>
                    <a href="<?=base_url()?>forgot-password" class="forgot-pass pull-right">Forgot Password</a>
                </div>
        </div>
    </div>
</div>

<section class="hero">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="assets/images/slider/home_slider_1.jpg" alt="" class="img-responsive">

                <div class="carousel-text">
                    <div class="container clearfix">
                        <div>
                            <h2>Quality home care for seniors</h2>

<!--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                Curabitur varius lectus eu libero pretium consectetur.</p>-->
                            <a href="<?=client_url('signup')?>" class="btn">Sign up to receive care</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="assets/images/slider/home_slider_2.jpg" alt="" class="img-responsive">

                <div class="carousel-text">
                    <div class="container clearfix">
                        <div>
                            <h2>Quality home care for seniors</h2>

<!--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                Curabitur varius lectus eu libero pretium consectetur.</p>-->
                            <a href="<?=client_url('signup')?>" class="btn">Sign up to receive care</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="assets/images/slider/home_slider_3.jpg" alt="" class="img-responsive">

                <div class="carousel-text">
                    <div class="container clearfix">
                        <div>
                            <h2>Quality home care for seniors</h2>

<!--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                Curabitur varius lectus eu libero pretium consectetur.</p>-->
                            <a href="<?=client_url('signup')?>" class="btn">Sign up to receive care</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="assets/images/slider/home_slider_1.jpg" alt="" class="img-responsive">

                <div class="carousel-text">
                    <div class="container clearfix">
                        <div>
                            <h2>Quality home care for seniors</h2>

<!--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in pulvinar urna.
                                Curabitur varius lectus eu libero pretium consectetur.</p>-->
                            <a href="<?=client_url('signup')?>" class="btn">Sign up to receive care</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#main-slider-->
