<?php //according to the wordpress codex, this is the default front-page for the website.
get_header(); ?>
<?php if (is_user_logged_in()) {?>
<form role="search" action="/" method="get" class="search-form">
    <label class="screen-reader-text" for="s"><h2>Search Courses</h2></label>
    <br />
    <input type="text" name="s" id="s" placeholder="What would you like to learn today?"/>
    <input type="submit" id="searchsubmit" value="Go" class="fa btn btn-default" />
    <div class="initial-facets">
        <button name="ifma_credential" value="fmp" type="submit" class="filter btn btn-default"><img src="http://cdn.ifma.org/sfcdn/education/fmp-logo_color_med836DBD92634D.jpg?sfvrsn=2" alt="Facility Management Professional" class="img-responsive img-rounded">FMP</button>
        <button name="ifma_credential" value="sfp" type="submit" class="filter btn btn-default"><img src="http://cdn.ifma.org/sfcdn/education/sfp-logo_color_medF85909A67844.jpg?sfvrsn=2" alt="Sustainability Facility Professional" class="img-responsive img-rounded">SFP</button>
        <button name="ifma_credential" value="cfm" type="submit" class="filter btn btn-default"><img src="http://cdn.ifma.org/sfcdn/education/cfm-logo_color_med182CC468D797.jpg?sfvrsn=2" alt="Certified Facility Manager" class="img-responsive img-rounded">CFM</button>
        <button name="ifma_credential" value="all" type="submit" class="filter btn btn-default"><img src="http://cdn.ifma.org/sfcdn/education/new_ifma_creds_compass_3in.png?sfvrsn=0" alt="All" class="img-responsive img-rounded">All</button>
    </div>
</form>
<?php } else { ?>
    <h1>Welcome to IFMA's Find a Course</h1>
             <h4>We are currently improving this service, and so ask that you use the current <a href="http://www.ifma.org/professional-development/educational-opportunities/find-a-course">Find a Course page</a> on our website</h4>
       <?php }?>
<?php get_footer(); ?>
