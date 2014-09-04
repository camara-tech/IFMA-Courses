<?php //according to the wordpress codex, this is the default front-page for the website.
get_header(); ?>

<div class="about-fm">
        <div class="about-fm-definition">

          <h2>What is Facility Management?</h2>
          <p>
              Facility Management is a profession that encompasses multiple disciplines to ensure functionality of the built environment by integrating people, place, process and technology.
          </p>
        </div>
        <div class="about-fm-competencies">
        <p>
            Our education focuses on the following 11 Core Competencies:
            <ul>
                <li>Communication</li>
                <li>Emergency Preparedness and Business Continuity</li>
                <li>Environmental Stewardship and Sustainability</li>
                <li>Finance &amp; Business</li>
              </ul>
              <ul>
                <li>Human Factors</li>
                <li>Leadership and Strategy</li>
                <li>Operations and Maintenance</li>
                <li>Project Management</li>
              </ul>
              <ul>
                <li>Quality</li>
                <li>Real Estate and Property Management</li>
                <li>Technology</li>
            </ul>
        </p>
    </div>
</div>

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
<?php get_footer(); ?>
