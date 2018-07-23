<?php
/**
 * The header for the Coming Soon theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coming_soon
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php bloginfo('description'); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11" rel="stylesheet">

<?php
$frontpage_id = get_option( 'page_on_front' );
$original_font = get_field('google_font', $frontpage_id);
$concat_font = str_replace(' ', '+', $original_font);
$extra_font = get_field('extra_google_font', $frontpage_id);
?>
<style>
  body{
    font-family: <?php echo esc_html($original_font); ?>
  }
</style>

<link href="https://fonts.googleapis.com/css?family=<?php echo esc_html($concat_font); ?>" rel="stylesheet">
<?php if ($extra_font): ?>
  <link href="<?php echo esc_url($extra_font); ?>" rel="stylesheet">
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'speziale_coming'); ?></a>

	<div id="content" class="site-content">
