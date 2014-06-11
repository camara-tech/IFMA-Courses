<div class="footer">
<div class="container">

<!-- footer logo -->
<div class="col-md-4 footer-column">
<a href="<?php echo site_url(); ?>"><img src="<?php echo esc_url(get_theme_mod('footer_image_setting')); ?>" alt="IFMA Logo" /></a>
</div>
<!-- footer menu 1-->
<div class="col-md-4 footer-column">
<?php if (dynamic_sidebar('footer-1')) : else : endif; ?>
</div>
<!-- footer Menu 2-->
<div class="col-md-4 footer-column">
<?php if (dynamic_sidebar('footer-2')) : else: endif; ?>
</div>
<!-- contact information-->
</div>
</div>
