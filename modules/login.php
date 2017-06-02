<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-form-page">
                <div class="form-contact">
                    <div class="col-md-6">
                        <h2>REGISTER</h2>
                        <form method="post">
                            <input type="hidden" name="action" value="signup"/>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="controls">
                                        <input  type="text" name="email"  placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-4 col-xs-12">
                                    <input type="text" name="firstname" placeholder="Firstname">
                                </div>
                                <div class="col-md-6 col-sm-4 col-xs-12">
                                    <input type="text" name="lastname" placeholder="Lastname">
                                </div>
                               
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="submit" value="Sign In" />
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <h2>SIGN IN</h2>
                        <form method="post">
                            <input type="hidden" name="action" value="login"/>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="controls">
                                        <input  type="text" name="email"  placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="password" placeholder="Password">
                                </div>                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="submit" value="Sign Up" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php //require_once 'modules/inc/contact-details.php'; ?>
        </div>
    </div>
</div>
<!-- End Content -->
