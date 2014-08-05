<?php //according to the wordpress codex, this is the default front-page for the website.
get_header(); ?>
<?php if (is_user_logged_in()) {?>
  <form role="search" action="<?php echo home_url('/'); ?>" method="get" class="search-form">
    <label class="screen-reader-text" for="s"><h2>Search Courses</h2></label>
    <br />
    <input type="text" name="s" id="s" placeholder="What would you like to learn today?"/>
    <input type="submit" id="searchsubmit" value="Go" class="btn btn-default" />
    <div class="initial-facets">
        <button name="ifma_credential" value="fmp" type="submit" class="filter btn btn-default"><img src="<?php echo get_template_directory_uri() . '/images/fmp-logo_color_med836DBD92634D.jpg'; ?>" alt="View all FMP Courses"><h3>View All FMP Courses</h3></button>
        <button name="ifma_credential" value="sfp" type="submit" class="filter btn btn-default"><img src="<?php echo get_template_directory_uri() . '/images/sfp-logo_color_medF85909A67844.jpg'; ?>" alt="View all SFP Courses"><h3>View All SFP Courses</h3></button>
        <button name="ifma_credential" value="cfm" type="submit" class="filter btn btn-default"><img src="<?php echo get_template_directory_uri() . '/images/cfm-logo_color_med182CC468D797.jpg'; ?>" alt="View all CFM Courses"><h3>View All CFM Courses</h3></button>
        <button name="ifma_credential" value="all" type="submit" class="filter btn btn-default"><h3>View All Courses</h3></button>
    </div>
</form>
<?php } else { ?>
    <h1>Welcome to IFMA's Find a Course</h1>
             <h4>We are currently improving this service, and so ask that you use the current <a href="http://www.ifma.org/professional-development/educational-opportunities/find-a-course">Find a Course page</a> on our website</h4>
       <?php }?>
<?php get_footer(); ?>
