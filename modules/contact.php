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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d151986.00533938778!2d-2.3636687929445515!3d53.472367954780005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487a4d4c5226f5db%3A0xd9be143804fe6baa!2sManchester%2C+UK!5e0!3m2!1sen!2s!4v1472467262148" width="1200" height="400" style="border:0" allowfullscreen></iframe>
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
