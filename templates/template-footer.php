<div class="footer">
<div class="container">

<!-- footer logo -->
<img src="<?php echo esc_url(get_theme_mod('footer_image_setting')); ?>" alt="IFMA Logo" />
<!-- footer menu 1-->
<?php if (dynamic_sidebar('footer1')) : else : endif; ?>
<!-- footer Menu 2-->
<?php if (dynamic_sidebar('footer2')) : else: endif; ?>
<!-- contact information-->
</div>
</div>
