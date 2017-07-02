<?php

  // Custom Query vars
  $post_type[] = 'sliders';

  // WP_Query arguments
  $args = array(
    'post_type'              => $post_type,
    'post_status'            => array( 'publish' ),
    'nopaging'               => true,
  );

  // The Query & Count
  $query = new WP_Query( $args );
  $count = $query->post_count;

  // Extra class for first active item
  $i = 0; if ( $i == 1 ) { $active = 'is-active'; }

?>

<?php if ( $query->have_posts() ) { ?>

  <div class="fullscreen-image-slider">
    <div class="orbit" role="region" aria-label="FullScreen Slider" data-count="<?php echo $count; ?>" data-orbit>
      <ul class="orbit-container">

        <?php if ( $count > 1 ) { ?>
          <button class="orbit-previous">
            <span class="show-for-sr">Previous Slide</span>
            <span class="nav fa fa-chevron-left fa-3x"></span>
          </button>
          <button class="orbit-next">
            <span class="show-for-sr">Next Slide</span>
            <span class="nav fa fa-chevron-right fa-3x"></span>
          </button>
        <?php } ?>

        <?php while ( $query->have_posts() ) { $query->the_post(); ?>

          <?php
            // ACF fields
            $image = get_field('dcf_slide_image');
            $overlay = get_field('dcf_slide_overlay');
            $caption = get_field('dcf_slide_caption');
            $link_type = get_field('dcf_slide_link');
            $link_url = get_field('dcf_slide_link_url');
            $link_text = get_field('dcf_slide_link_text');
            if( !empty($image) ) {
              // Image vars
              $image_id = $image['id'];
              // $image_url = $image['url'];
              // $image_title = $image['title'];
              // $image_alt = $image['alt'];
              // $image_caption = $image['caption'];

              // Get WP responsive markup
              $responsive_image = wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'orbit-image' ) );
              $responsive_image_src = wp_get_attachment_image_url( $image_id, 'full' );
            }
          ?>

          <li class="orbit-slide<?php if ( isset($active) ) { echo $active; } ?>" <?php if ( isset($responsive_image_src) ) { echo 'style="background-image: url(\''.$responsive_image_src.'\')'; } ?>">

            <?php if ( $link_type == 'slide' && !empty($link_url) ) { ?><a href="<?php echo $link_url; ?>"><?php } ?>

            <?php if ( isset($responsive_image) ) { echo apply_filters( 'the_content', $responsive_image ); } ?>
            <?php if ( isset($caption) ) { ?>
              <figcaption class="orbit-caption">
                <h1><?php echo $caption; ?></h1>
                <?php if ( $link_type == 'button' && !empty($link_url) ) { ?>
                  <a href="<?php echo $link_url; ?>" class="button"><?php if (!empty($link_text)) { echo $link_text; } else { echo 'Find our more'; } ?></a>
                <?php } ?>
              </figcaption>
            <?php } ?>
            <?php if ( isset($overlay) ) { ?><div class="orbit-overlay <?php echo $overlay; ?>"></div><?php } ?>

            <?php if ( $link_type == 'slide' && !empty($link_url) ) { ?></a><?php } ?>

          </li>
        <?php } ?>

      </ul>
    </div>
  </div>

<?php } ?>

<?php
  // Restore original Post Data
  wp_reset_postdata();
?>