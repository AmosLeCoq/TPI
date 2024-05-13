<?php
/**
 * @file      gabarit.php
 * @author    Created by Amos Le Coq
 * @version   06.05.2024
 */

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$title; ?></title>
        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="view/content/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="view/content/css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="view/content/css/style.css" />
        <link rel="stylesheet" type="text/css" href="view/content/css/pluton.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="view/content/css/pluton-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="view/content/css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="view/content/css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="view/content/css/animate.css" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="view/content/images/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="view/content/images/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="view/content/images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="view/content/images/ico/apple-touch-icon-57.png">
        <link rel="shortcut icon" href="view/content/images/ico/favicon.ico">
    </head>
    
    <body>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a href="#" class="brand">
                        <img src="view/content/images/CPNV.png" width="120" height="40" alt="Logo" />
                        <!-- This is website logo -->
                    </a>
                    <!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                            <li class="active"><a href="index.php?action=home">Home</a></li>
                            <li><a href="index.php?action=stage">Stage</a></li>
                            <?php if (isset($_SESSION['type'])) : ?>
                                <li><a href="index.php?action=logout">Logout</a></li>
                            <?php else : ?>
                                <li><a href="index.php?action=login">Login</a></li>
                            <?php endif;?>
                            <?php if (isset($_SESSION['type'])) : ?>
                                <?php if ($_SESSION['type']=="admin") : ?>
                                    <li><a href="index.php?action=admin">Admin</a></li>
                                <?php endif;?>
                            <?php endif;?>
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>
        <br>
        <?=$content; ?>
        <br>
        <!-- Footer section start -->
        <div class="footer">
            <p>&copy; 2013 Theme by <a href="http://www.graphberry.com">GraphBerry</a></p>
        </div>
        <!-- Footer section end -->
        <!-- ScrollUp button start -->
        <div class="scrollup">
            <a href="#">
                <i class="icon-up-open"></i>
            </a>
        </div>
        <!-- ScrollUp button end -->
        <!-- Include javascript -->
        <script src="view/content/js/jquery.js"></script>
        <script type="text/javascript" src="view/content/js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="view/content/js/bootstrap.js"></script>
        <script type="text/javascript" src="view/content/js/modernizr.custom.js"></script>
        <script type="text/javascript" src="view/content/js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="view/content/js/jquery.cslider.js"></script>
        <script type="text/javascript" src="view/content/js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="view/content/js/jquery.inview.js"></script>
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="view/content/js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="view/content/js/app.js"></script>
    </body>
</html>