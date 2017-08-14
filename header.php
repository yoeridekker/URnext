<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title(); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- favicons -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Image and text -->
    <nav class="navbar navbar sticky-top navbar-light bg-faded" style="background:rgba(0,0,0,0.03); border-bottom: 1px solid rgba(0,0,0,0.1)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <a class="navbar-brand" href="<?php echo site_url(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                        URnext
                    </a>
                    <div class="toggle-button" id="toggle">
                        <span class="bar top"></span>
                        <span class="bar middle"></span>
                        <span class="bar bottom"></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="overlay" id="overlay">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>