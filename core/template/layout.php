<?php
// Before anything is sent, set the appropriate header
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="Bookhive Kenya" />
        <meta name="keywords" content="bookhive  kenya" />
        <meta name="robots" content="noodp,index,follow" />
        <meta name='revisit-after' content='1 days' />
        <link rel="icon" href="images/faviconr.ico" type="image/ico" sizes="16x16 32x32">
        <link rel="icon" href="images/faviconr.png" type="image/png" sizes="16x16 32x32">
        <link rel="icon" href="images/faviconr.svg" type="image/png" sizes="16x16 32x32">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="web/css/libs/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/bootstrap-theme.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/jquery.fancybox.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/jquery-ui.min.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/owl.carousel.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/owl.transitions.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/owl.theme.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/jquery.mCustomScrollbar.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/animate.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/libs/hover.css"/>
        <link rel="stylesheet" type="text/css" href="web/css/color-red.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="web/css/theme.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="web/css/responsive.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="web/css/browser.css" media="all"/>
        <!-- <link rel="stylesheet" type="text/css" href="web/css/rtl.css" media="all"/> -->

        <?php
        /*         * *
         * This section specifies the page header
         */

        // The page title
        if ($templateResource = TemplateResource::getResource('title')) {
            ?>
            <title><?php echo $templateResource; ?></title>
        <?php } ?>	
        <!-- Basic CSS -->
        <!-- End of basic CSS -->
        <?php
        // The CSS included
        if ($templateResource = TemplateResource::getResource('css')) {
            ?>
            <!-- Additional CSS -->
            <?php
            foreach ($templateResource as $style) {
                $style = "web/$style";
                ?>
                <link rel="stylesheet" href="<?php echo $style; ?>" />
                <?php
            }
            ?>
            <!-- Additional CSS end -->
            <?php
        }
        ?>

        <!-- Favicon and touch icons -->


    </head>
    <!--    <body>-->

    <body style="background:#f4f4f4">
        <div class="wrap">
            <?php
            if (is_menu_set('quick-view') != "") {
                
            } else {
                require_once "header.php";
            }
            ?>

            <?php
            require_once $currentPage;
            ?>

            <?php
            if (is_menu_set('quick-view') != "") {
                
            } else {
                require_once "footer.php";
            }
            ?>

            <!-- Basic scripts -->  
            <script type="text/javascript" src='web/js/libs/jquery.min.js'></script>
            <script type="text/javascript" src="web/js/libs/jquery.js"></script>
            <script type="text/javascript" src="web/js/libs/bootstrap.min.js"></script>
            <script type="text/javascript" src="web/js/libs/jquery.fancybox.js"></script>
            <script type="text/javascript" src="web/js/libs/jquery-ui.min.js"></script>
            <script type="text/javascript" src="web/js/libs/owl.carousel.js"></script>
            <script type="text/javascript" src="web/js/libs/jquery.jcarousellite.js"></script>
            <script type="text/javascript" src="web/js/libs/jquery.mCustomScrollbar.js"></script>
            <script type="text/javascript" src="web/js/libs/jquery.flexslider.js"></script>
            <script type="text/javascript" src="web/js/libs/jquery.elevatezoom.js"></script>
            <script type="text/javascript" src="web/js/libs/TimeCircles.js"></script>
            <script type="text/javascript" src="web/js/libs/wow.js"></script>
            <script type="text/javascript" src="web/js/libs/popup.js"></script>
            <script type="text/javascript" src="web/js/theme.js"></script>
            <script type="text/javascript" src="web/js/incrementing.js"></script>
            <script type="text/javascript">
                function incrementValue()
                {
                    var value = parseInt(document.getElementById('number').value, 10);
                    value = isNaN(value) ? 0 : value;
                    if (value < 10) {
                        value++;
                        document.getElementById('number').value = value;
                    }
                }
                function decrementValue()
                {
                    var value = parseInt(document.getElementById('number').value, 10);
                    value = isNaN(value) ? 0 : value;
                    if (value > 1) {
                        value--;
                        document.getElementById('number').value = value;
                    }

                }
            </script>
            <!-- End of basic scripts -->
            <?php
            /*             * *
             * Specify the scripts that are to be added.
             */
            if ($templateResource = TemplateResource::getResource('js')) {
                ?>
                <!-- Additional Scripts -->
                <?php
                foreach ($templateResource as $js) {
                    $js = "web/$js";
                    ?>
                    <script src="<?php echo $js; ?>"></script>
                    <?php
                }
                ?>
                <?php
            }
            ?>
            <?php if (!App::isLoggedIn()) { ?>
                <script>
                jQuery(document).ready(function () {
                    App.initLogin();
                });
                </script>
            <?php } else { ?>
                <script>
                    jQuery(document).ready(function () {
                        // initiate layout and plugins
                        App.init();
                        //App.setMainPage(true);

                    });
                </script>
                <?php
            }
            ?>
        </div>
    </body>
</html>
