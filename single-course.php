<?php get_header(); ?>

<!-- start content container -->
<div class="row dmbs-content">

    <?php get_template_part('template-part', 'search'); ?>
    <div class="col-md-<?php devdmbootstrap3_main_content_width(); ?> dmbs-main">

            <?php // theloop
                if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <div <?php post_class(); ?>>

                            <h2 class="course-title page-header"><?php the_title() ;?></h2>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail(); ?>
                                <div class="clear"></div>
                            <?php endif; ?>
                            <div class="course-details">
                            <p><i class="fa fa-calendar"></i> <?php echo date('M d, Y',strtotime(get_field('start_date'))); ?></p>


                            <p><i class="fa fa-road"></i> <?php array_walk(get_field('delivery_method'),'walk_delivery_method'); ?></p>

                            <?php if (get_field("accredited")=="Yes") { ?>
                            <p><i class="fa fa-check"></i> Accredited</p>
                            <?php } else { ?>
                            <p><i class="fa fa-ban"></i> Accredited</p>
                            <?php } ?>


                            <p><i class="fa fa-globe"></i> <a href="<?php get_field("website"); ?>">Website</a></p>
                                       </div>

                            <div class="course-info">

                                           <div class="course-credential img-responsive pull-right">
                                    <?php

                                    if (in_category('fmp')){
                                    echo '<img src="http://cdn.ifma.org/sfcdn/education/fmp-logo_color_med836DBD92634D.jpg?sfvrsn=2" alt="FMP Logo">';
                                    }

                                    if (in_category('sfp')){
                                    echo '<img src="http://cdn.ifma.org/sfcdn/education/sfp-logo_color_medF85909A67844.jpg?sfvrsn=2" alt="SFP Logo">';
                                    }

                                    if (in_category('cfm')){
                                    echo '<img src="http://cdn.ifma.org/sfcdn/education/cfm-logo_color_med182CC468D797.jpg?sfvrsn=2" alt="CFM Logo">';
                                    }

                                    ?>
                                </div>
                                <p>Provided By: <?php echo get_field("provided_by"); ?></p>
                                <?php $instructor = get_field('instructor');
                                    if ($instructor) {
                                        $name = get_field('first_name',$instructor[0])." ".get_field('last_name',$instructor[0]);
                                    }
                                ?>
                                <p>Instructor: <?php echo $name; ?></p>
                                <p>CEU Level: <?php echo get_field("level"); ?></p>


                            </div>

                            <div class="course-content">

                            <h3>Course Description/Syllabus</h3>
                            <div class="course-location">

                            <?php
                            // map stuff
                            $location = get_field('map_location');
                            if ($location) {
                                $place = get_field('map_location',$location[0]);
                                echo "<p>Address: {$place['address']}</p>";
                                echo "<img src='http://maps.googleapis.com/maps/api/staticmap?markers=".$place['lat'].",".$place['lng']."&zoom=13&size=400x400&sensor=false' alt='map location'>";
                            }
                           ?>
                                </div>
                            <?php the_content(); ?></div>

                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta'); ?>
                            <?php comments_template(); ?>

                        </div>
                       <?php endwhile; ?>
                <?php posts_nav_link(); ?>
                <?php else: ?>

                    <?php get_404_template(); ?>

            <?php endif; ?>

   </div>

   <?php //get the right sidebar ?>
   <?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>

