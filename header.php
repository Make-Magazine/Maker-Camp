<?php
/**
 * Maker Camp header template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Maker Media Web Team: Jake Spurlock, Bill Olson, Cole Geissinger and David Beauchamp <webmaster@makermedia.com>
 *
 */
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php wp_title(); ?></title>
		<meta name="google-site-verification" content="tjgq9UGR8WCMZI_40j_B5wda_oVYqKyFtQW547LzMgQ" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
		<meta property="og:image" content="http://makercamp.com/wp-content/uploads/2014/07/maker-camp-01.png" />
		<!-- Le styles -->
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<?php wp_head( 'makercamp' ); ?>

	</head>
	<body <?php body_class( 'makercamp' ); ?>>
		<header>
			<div class="navbar main-nav navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<div class="row-fluid">
							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
							<a href="<?php echo esc_url( home_url() ); ?>" class="brand visible-phone visible-tablet">Maker Camp</a>
							<div class="nav-collapse in collapse">
								<?php
									// All Navigational items are controlled in Appearance > Menus : Maker Camp Nav
									wp_nav_menu( array(
										'theme_location' => 'mc-header-menu',
										'container' => '',
										'menu_class' => 'nav primary-nav nav-inline',
										'walker' => new Bootstrap_Walker_Nav_Menu(),
									) );
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

