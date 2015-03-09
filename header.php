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
		<!-- Le styles -->
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-51157-25', 'auto');
			  ga('require', 'displayfeatures');
			  ga('send', 'pageview', {
			  'page': location.pathname + location.search  + location.hash
			        });
		</script>

		<script>
			var _prum = [['id', '53fcea2fabe53d341d4ae0eb'],
			            ['mark', 'firstbyte', (new Date()).getTime()]];
			(function() {
			    var s = document.getElementsByTagName('script')[0]
			      , p = document.createElement('script');
			    p.async = 'async';
			    p.src = '//rum-static.pingdom.net/prum.min.js';
			    s.parentNode.insertBefore(p, s);
			})();
		</script>

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

