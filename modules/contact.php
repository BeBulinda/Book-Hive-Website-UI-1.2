<?php
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
if (!empty($_POST)) {
    $success = $transactions->execute();
    if (is_bool($success) && $success == true) {
        //send email
//        $email = $_POST['email'];
//        $subject = 'WEBSITE INQUIRY: ' . strtoupper($_POST['subject']);
//        $message = $_POST['message'];
//        $receiver = "info@reflexconcepts.co.ke";
//        $mail = mail($receiver, "Subject: $subject", $message, "From: $email");
//        if ($mail) {
//            echo '<p class="link_to"> Message Sent. Getting back to you shortly.</p>';
//        } else {
//            echo '<p class="warning"> Error sending message. Please try again.</p>';
//        }

        $_SESSION['add_success'] = true;

        App::redirectTo("?register");
    }
}
?>
<div id="content">
    <div class="content-page">
        <div class="container">
            <div class="contact-map">
                <iframe src="//www.google.com/maps/embed/v1/place?q=Reflex%20Concepts%20LTD
                        &zoom=13
                        &attribution_source=Google+Maps+Embed+API
                        &attribution_web_url=https://developers.google.com/maps/documentation/embed/
                        &key=AIzaSyDGJGqlWDQzM6wkBKerScg5uEG5tv09xyQ" width="1200" height="400" style="border:0" allowfullscreen></iframe>
            </div>
            <!-- End Map -->
            <?php require_once 'modules/inc/contact-details.php'; ?>
            <div class="contact-form-page">
                <h2>contact form</h2>
                <div class="form-contact">
                    <form method="post">
                        <input type="hidden" name="action" value="contact_us"/>
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="name" placeholder="Name *">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <input type="text" name="email" placeholder="Email *">
                            </div>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" name="website" placeholder="Website">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <textarea name="message" cols="30" rows="8" placeholder="Message"></textarea>
                                <input type="submit" value="Send" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
