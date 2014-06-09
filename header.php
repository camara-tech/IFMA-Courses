<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title('|',true,'right'); ?></title>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
<?php wp_head(); ?>
</head>
  <body <?php body_class(); ?>>
<?php 
get_template_part('templates/template','micro_nav');
get_template_part('templates/template','utility');
get_template_part('templates/template','header');
get_template_part('templates/template','navigation');
?>

<div class=container>
