<?php /* Template Name: home page */
$template = get_template_directory_uri();
$images = $template . '/images';

$logo = get_field('logo');
$logo_bg_color = get_field('logo_background_color');
list($r, $g, $b) = sscanf($logo_bg_color, "#%02x%02x%02x");
$opacity = get_field('logo_background_opacity');
$opacity = $opacity ? $opacity : 1;
$logo_bg_color_rgb = "rgba(" .$r. "," .$g. "," .$b. "," .$opacity. ")";


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
list($r, $g, $b) = sscanf($contact_background_colour, "#%02x%02x%02x");
$opacity = get_field('contact_background_opacity');
$opacity = $opacity ? $opacity : 1;
$contact_bg_color_rgb = "rgba(" .$r. "," .$g. "," .$b. "," .$opacity. ")";
$contact_text_colour = get_field('contact_text_colour');
$contact_font_size = get_field('contact_font_size');

$phone = get_field('phone');
$email = get_field('email');
$address = get_field('address');
$bg_image = get_field('background_image');
$border = get_field('border');

$copyright_mar_t = get_field('copyright_mar_t');
$copyright_brand = get_field('copyright_brand');
$copyright_brand = $copyright_brand ? $copyright_brand : get_bloginfo('title');
$copyright_colour = get_field('copyright_colour');
$copyright_colour = $copyright_colour ? $copyright_colour : 'inherit';
$copyright_font_size = get_field('copyright_font_size');
$copyright_force_breaks = get_field("copyright_force_breaks")
?>

<?php get_header(); ?>

<div id="slider">
  <?php
  $slider_gallery = get_field("slider_gallery");

	if ($slider_gallery) {
    foreach ($slider_gallery as $gallery_item) {
      $id = $gallery_item['ID'];
      echo wp_get_attachment_image($id, 'full');
    }
  }
  ?>
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
      <?php
        $style = $logo_bg_color ? 'background-color: ' .$logo_bg_color_rgb .';' : "background-color: transparent;";
      ?>

      <?php if ($logo): ?>
        <div class="panel__logo" style="<?php echo esc_attr($style); ?>">
          <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
  			</div>
      <?php endif; ?>	

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

        <!-- Lists -->
				<?php if (have_rows("panel_lists")): ?>
          <div class="panel__lists-wrapper">
            <?php while (have_rows("panel_lists")): the_row(); ?>
              <div class="panel__list-wrapper">
                <?php
                $title = get_sub_field('list_title');
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
            <?php endwhile; ?>
          </div>
        <?php endif; ?>

      </div><!-- /content -->

      <!-- Contact -->
      <?php
        $bg_colour = $contact_background_colour ? 'background-color: ' .$contact_bg_color_rgb .';' : 'background-color: transparent;';
      ?>
      <div class="panel__contact-wrapper" style="<?php echo $bg_colour; ?> color: <?php echo sanitize_hex_color($contact_text_colour); ?>; font-size: <?php echo ($contact_font_size ? esc_attr($contact_font_size) : "16px"); ?>;">

        <!-- Contact WYSIWYG -->
        <div class="panel__contact-wysiwyg">
          <?php echo get_field("contact_wysiwyg"); ?>
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
        <div class="panel__copyright" <?php echo ($copyright_mar_t ? "style=\"margin-top: ".$copyright_mar_t.";\"" : "" ); ?>>
          <p class="panel__copyright-statement" style="color: <?php echo esc_attr($copyright_colour); ?>; font-size: <?php echo ($copyright_font_size ? $copyright_font_size : '12px'); ?>;">
            <span class="panel__copyright-brand <?php echo $copyright_force_breaks ? "panel__copyright-break panel__copyright-break--mobile-only" : "" ?>">
              <span class="panel__copyright-brand-copyright <?php echo $copyright_force_breaks ? "panel__copyright-break panel__copyright-break--mobile-only" : "" ?>">Copyright &copy; <?php echo date('Y'). ' ' .esc_html($copyright_brand); ?>.</span>
              <span class="panel__copyright-brand-rights <?php echo $copyright_force_breaks ? "panel__copyright-break panel__copyright-break--mobile-only" : "" ?>">All rights reserved.</span>
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
