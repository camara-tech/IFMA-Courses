<?php get_header(); ?>

<!-- start content container -->
<div id="content">
    <div class="row">
    <?php //get_template_part('template-part', 'search'); ?>

        <div class="col-lg-4 responsive-sidebar pull-right rst-off" id="rst">
            <div class="responsive-sidebar-toggle"><div class="toggle-spacer"></div><span class="arrow closed"></span></div>
            <div class="responsive-sidebar-content">
            <?php get_sidebar('news'); ?>
            </div>
        </div>

        <div class="col-lg-8 main-content">

        <?php // theloop
                if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <div <?php post_class(); ?>>

                            <h2 class="page-header course-title"><?php the_title() ;?></h2>

                            <div class="course-details">
                            <p><i class="fa fa-calendar"></i> <?php echo date('M d, Y',strtotime(get_field('start_date'))); ?></p>


                            <p><i class="fa fa-road"></i> <?php if (is_array(get_field('delivery_method'))) {
                              array_walk(get_field('delivery_method'),'walk_delivery_method');
                               } else {
                                   echo get_field('delivery_method');
                               }
                               ?></p>

                            <?php if (get_field("accredited")=="Yes") { ?>
                            <p><i class="fa fa-check"></i> Accredited</p>
                            <?php } else { ?>
                            <p><i class="fa fa-ban"></i> Accredited</p>
                            <?php } ?>


                            <p><i class="fa fa-globe"></i> <a href="<?php get_field("website"); ?>">Website</a></p>
                                       </div>

                            <div class="course-info">


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

                            <?php the_content(); ?></div>

                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta'); ?>


                        </div>
                       <?php endwhile; ?>
                <?php posts_nav_link(); ?>
                <?php else: ?>

                    <?php get_404_template(); ?>

            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
