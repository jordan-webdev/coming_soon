<?php /* Template Name: home page */
$template = get_template_directory_uri();
$images = $template . '/images';

$logo = get_field('logo');
$logo_bg_color = get_field('logo_background_color');
$coming_soon_graphic = get_field('coming_soon_graphic');
$coming_soon_graphic_mobile = get_field('coming_soon_graphic_mobile');
$font_color = get_field('font_colour');

$body_bg_color = get_field('body_background_color');
$hex = $body_bg_color;
list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
$opacity = get_field('body_background_opacity');
$opacity = $opacity ? $opacity : 1;
$body_bg_color_rgb = "rgba(" .$r. "," .$g. "," .$b. "," .$opacity. ")";

$contact_background_colour = get_field('contact_background_colour');
$contact_text_colour = get_field('contact_text_colour');
$contact_font_size = get_field('contact_font_size');
$phone = get_field('phone');
$email = get_field('email');
$address = get_field('address');
$bg_image = get_field('background_image');
$include_list = get_field('include_list');
$border = get_field('border');

$copyright_brand = get_field('copyright_brand');
$copyright_brand = $copyright_brand ? $copyright_brand : get_bloginfo('title');
$copyright_colour = get_field('copyright_colour');
$copyright_colour = $copyright_colour ? $copyright_colour : 'inherit';
$copyright_font_size = get_field('copyright_font_size');
$copyright_force_breaks = get_field("copyright_force_breaks")
?>

<?php get_header(); ?>

<?php
    $args = array(
        'post_type' => 'images'
    );
    $query = new WP_Query($args);
?>

<div id="slider">
	<?php if ($query->have_posts()) : ?>
		<?php while ($query->have_posts()) : $query->the_post(); ?>
			<?php the_post_thumbnail(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</div>

<!-- Panel -->
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <?php
      $width = get_field('border_width');
      $radius = get_field('border_radius');
      $color = get_field('border_color');
      $style = $border ? 'border: ' .$width. ' solid ' .$color. '; border-radius: ' .$radius : false;
      $bg_style = $bg_image ? 'background-image: url(' . esc_url($bg_image['url']) .');' : '';
   ?>

  <div class="panel-wrapper">
		<div class="panel" style="<?php echo esc_attr($bg_style); ?> <?php echo esc_attr($style); ?>">

      <!-- Full Website Image -->
      <div class="panel__full-site-banner">
        <?php if ($coming_soon_graphic): ?>
          <img src="<?php echo esc_url($coming_soon_graphic['url']); ?>" alt="<?php echo esc_attr($coming_soon_graphic['alt']); ?>">
        <?php else: ?>
          <img src="<?php echo $images; ?>/full-site-min.png" alt="Full Website Coming Soon">
        <?php endif; ?>
      </div>

      <!-- Full Website Image (Mobile) -->
      <div class="panel__full-site-banner--mobile">
        <?php if ($coming_soon_graphic_mobile): ?>
          <img src="<?php echo esc_url($coming_soon_graphic_mobile['url']); ?>" alt="<?php echo esc_attr($coming_soon_graphic_mobile['alt']); ?>">
        <?php else: ?>
          <img src="<?php echo $images; ?>/full-site-mobile-min.jpg" alt="Full Website Coming Soon">
        <?php endif; ?>
      </div>

      <!-- Logo -->
      <?php $style = $logo_bg_color ? 'background-color: ' .$logo_bg_color .';' : 'background-color: transparent;'; ?>

			<div class="panel__logo" style="<?php echo esc_attr($style); ?>">
        <img src="<?php echo esc_url($logo['url']); ?> ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
			</div>

      <!-- Content -->
      <?php
        $bg_colour = $body_bg_color ? 'background-color: ' .$body_bg_color_rgb .';' : 'background-color: transparent;';
        $colour = $font_color ? 'color: ' .$font_color. ';' : 'color: black;';
      ?>

			<div class="panel__content-wrapper" style="<?php echo esc_attr($bg_colour); ?> <?php echo esc_attr($colour); ?>">

				<header class="panel__header">
					<?php the_title('<h1 class="panel__title">', '</h1>'); ?>
				</header>

				<div class="panel__content">
					<?php the_content(); ?>
				</div>

        <!-- List -->
				<?php if ($include_list): ?>
          <div class="panel__list-wrapper">
            <?php
            $title = get_field('list_title');
            if ($title):
            ?>
            <div class="panel__list-title-wrapper">
              <div style="background-color: <?php echo sanitize_hex_color($font_color); ?>" class="panel__list-title-line"></div>
              <h2 class="panel__list-title"><?php echo esc_html($title); ?></h2>
              <div style="background-color: <?php echo sanitize_hex_color($font_color); ?>" class="panel__list-title-line"></div>
            </div>
            <?php endif; ?>

            <?php if (have_rows('list_items')): ?>
              <ul class="panel__list">
                <?php while (have_rows('list_items')): the_row(); ?>
                  <?php $list_item = get_sub_field('list_item'); ?>
                  <li class="panel__list-item"><?php echo esc_html($list_item); ?></li>
                <?php endwhile; ?>
              </ul>
            <?php endif; ?>
          </div>
        <?php endif; ?>

      </div><!-- /content -->

      <!-- Contact -->
      <div class="panel__contact-wrapper" style="background-color:<?php echo sanitize_hex_color($contact_background_colour); ?>; color: <?php echo sanitize_hex_color($contact_text_colour); ?>; font-size: <?php echo ($contact_font_size ? esc_attr($contact_font_size) : "16px"); ?>;">

        <!-- Contact Items -->
        <div class="panel__contact">
          <?php if ($phone): ?>
            <a class="panel__contact-item" href="tel:<?php echo esc_attr($phone); ?>">
              <span class="bold">Phone</span>
              <?php echo esc_html($phone); ?>
            </a>
          <?php endif; ?>

          <?php if ($email): ?>
            <a class="panel__contact-item" href="mailto:<?php echo esc_attr($email); ?>">
              <span class="bold">Email</span>
              <?php echo esc_html($email); ?>
            </a>
          <?php endif; ?>

          <?php if ($address): ?>
            <a class="panel__contact-item" href="https://www.google.ca/maps/place/<?php echo esc_attr($address); ?>">
              <span class="bold">Address</span>
              <?php echo esc_html($address); ?>
            </a>
          <?php endif; ?>
        </div>

        <!-- Social Media -->
        <?php if (have_rows('social_media')): ?>
          <ul class="panel__social-media-list">
            <?php while (have_rows('social_media')): the_row();
              $platform = get_sub_field('platform');
              $link = get_sub_field('social_media_link');
            ?>
            <li class="panel__social-media-list-item">
              <a href="<?php echo esc_url($link); ?>">
                <span class="fa fa-<?php echo esc_attr($platform); ?>" aria-hidden="true"></span>
              </a>
            </li>
            <?php endwhile; ?>
          </ul>
        <?php endif; ?>

        <!-- Copyright -->
        <div class="panel__copyright">
          <p class="panel__copyright-statement" style="color: <?php echo esc_attr($copyright_colour); ?>; font-size: <?php echo ($copyright_font_size ? $copyright_font_size : '12px'); ?>;">
            <span class="panel__copyright-brand">
              <span class="panel__copyright-brand-copyright <?php echo $copyright_force_breaks ? "panel__copyright-break" : "" ?>">Copyright &copy; <?php echo date('Y'). ' ' .esc_html($copyright_brand); ?>.</span>
              <span class="panel__copyright-brand-rights <?php echo $copyright_force_breaks ? "panel__copyright-break" : "" ?>">All rights reserved.</span>
            </span>
            <span class="panel__copyright-designed <?php echo $copyright_force_breaks ? "panel__copyright-break" : "" ?>">
              Design and Development by
              <a class="panel__copyright-designed-link" href="http://www.dolcemedia.ca/" rel="noopener noreferrer" target="_blank">Dolce Media Group</a>
            </span>
          </p>
        </div>

      </div><!-- panel__content-wrapper -->

    </div><!-- /panel -->

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
