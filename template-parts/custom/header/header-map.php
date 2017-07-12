<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS/header.php'));

	// Extra class for panel content
		$content_class = 'hero-map';

?>

<?php if ( isset($header_option) ) { ?>
	<?php if( !empty($contact_address_map) ) { ?>
		<div class="<?php echo $content_class; ?> <?php if ( isset($map_class) ) { echo $map_class; } ?>" <?php if ( isset($header_map_style) ) { echo $header_map_style; } ?>>
			<div class="marker" data-lat="<?php echo $contact_address_lat; ?>" data-lng="<?php echo $contact_address_lng; ?>"></div>
		</div>
	<?php } ?>

	<?php if ( isset($hero_map_custom) && $hero_map_option == 'global' && isset($hero_map_details) && $hero_map_details ) { ?>
		<div class="hero-details">
			<div class="contact-details">
				<?php if( isset($contact_phone_number) ) { ?>
					<p class="phone"><a href="tel:<?php echo $contact_phone_number; ?>" title="Phone number" target="_blank">
						<i class="fa fa-fw fa-phone" aria-hidden="true"></i>
						<span><?php echo $contact_phone_number; ?></span>
					</a></p>
				<?php } ?>

				<?php if( isset($contact_fax_number) ) { ?>
					<p class="fax"><a href="tel:<?php echo $contact_fax_number; ?>" title="Fax number" target="_blank">
						<i class="fa fa-fw fa-fax" aria-hidden="true"></i>
						<span><?php echo $contact_fax_number; ?></span>
					</a></p>
				<?php } ?>

				<?php if( isset($contact_mobile_number) ) { ?>
					<p class="phone"><a href="tel:<?php echo $contact_mobile_number; ?>" title="Phone number" target="_blank">
						<i class="fa fa-fw fa-phone" aria-hidden="true"></i>
						<span><?php echo $contact_mobile_number; ?></span>
					</a></p>
				<?php } ?>

				<?php if( isset($contact_email_address) ) { ?>
					<p class="email"><a href="mailto:<?php echo $contact_email_address; ?>" title="Email address" target="_blank">
						<i class="fa fa-fw fa-paper-plane" aria-hidden="true"></i>
						<span><?php echo $contact_email_address; ?></span>
					</a></p>
				<?php } ?>

				<?php if( isset($contact_address) ) { ?>
					<p class="address"><a href="http://maps.google.com/?q=<?php echo $contact_address; ?>" title="Map link" target="_blank">
						<i class="fa fa-fw fa-map-marker" aria-hidden="true"></i>
						<?php if( isset($contact_address_text) ) { ?>
							<span><?php echo $contact_address_text; ?></span>
						<?php } else { ?>
							<span><?php echo $contact_address; ?></span>
						<?php } ?>
					</a></p>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
<?php } ?>