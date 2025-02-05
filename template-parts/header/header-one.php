<?php
/**
* Template Name: Header Two
*
*/
?>
<header id="masthead" class="site-header header-one" style="background-image: url(<?php echo esc_url( get_header_image() ); ?>);">
	<?php
	$gettopbar  = get_theme_mod( 'top_header_on_off', false );
	$getAddressValue  = get_theme_mod( 'top_header_address', 'lovelyway.cn' );
	$getPhoneValue  = get_theme_mod( 'top_header_phone', '+1 123-456-7890' );
	$social_facebook  = get_theme_mod( 'social_facebook', 'https://facebook.com/' );
	$social_instagram  = get_theme_mod( 'social_instagram', 'https://instagram.com/' );
	$social_linkedin  = get_theme_mod( 'social_linkedin', 'https://linkedin.com/' );
	$social_twitter  = get_theme_mod( 'social_twitter', 'https://twitter.com/' );
	if ( true == $gettopbar ) :
	?>
	<div class="top-header">
		<div class="container">
			<div class="row top-header__wrapper">
				<div class="top-details">
					<div class="site-branding header-info">
						<ul class="address-contact-info">
							<li><i class="fa fa-map-marker"></i><span class="address"><?php echo $getAddressValue; ?></span></li>
							<li><i class="fa fa-phone"></i><span class="phone"><?php echo $getPhoneValue; ?></span></li>
						</ul>
					</div><!-- .site-branding -->
				</div>
				<div class="top-social">
					<div class="cssmenu text-right" id="cssmenu">
						<ul class="social-links">
							<li><a href="<?php echo $social_facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<li><a href="<?php echo $social_instagram;?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
							<li><a href="<?php echo $social_linkedin;?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="<?php echo $social_twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	endif;

	$main_logo = get_theme_mod( 'header_main_logo', 'lw-logo.png' );
	$sub_logo = get_theme_mod( 'header_sub_logo', 'lw-logo-sub.png' );
	?>
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-md-3 align-self-center">
					<div class="site-branding header-logo">
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo lwmain_get_image_url_by_filename($main_logo) ?>" style="height:48px" />
							<img src="<?php echo lwmain_get_image_url_by_filename($sub_logo) ?>" style="height:48px" />
						</a></h1>
					</div><!-- .site-branding -->
				</div>
				<div class="col-md-9 m-auto align-self-center text-right">
					<div class="cssmenu text-right" id="cssmenu">
						<?php
						wp_nav_menu(
							array(
								'theme_location'    => 'main-menu',
								'container'         => 'ul',
							)
						);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header><!-- #masthead -->
