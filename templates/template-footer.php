<div class="footer">
<div class="container">

<!-- footer logo -->
<div class="col-md-4 footer-column">
<a href="<?php echo "http://www.ifma.org"; ?>">
<?php if (get_option('footer_image_setting')) { ?>
<img src="<?php echo get_option('footer_image_setting'); ?>" alt="IFMA Logo" />
<?php } else { ?>
<img src="<?php echo get_template_directory_uri() . '/images/footer.png'; ?>" alt="IFMA Logo" />
<?php } ?>
</a>
</div>
<!-- footer menu 1-->
<div class="col-md-5 footer-column">
<?php if (dynamic_sidebar('footer-1')) : else : endif; ?>
</div>
<!-- footer Menu 2-->
<div class="col-md-3 footer-column">
<?php if (dynamic_sidebar('footer-2')) : else: endif; ?>
</div>
<!-- contact information-->
</div>
</div>
