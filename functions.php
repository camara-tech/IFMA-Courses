<?php
#let's make sure that the bootstrap font-awesome system is included
function include_font_awesome() {
    wp_register_style('font-awesome.css', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
    wp_enqueue_style('font-awesome.css');
}
add_action('wp_enqueue_scripts','include_font_awesome');

function include_knockoutjs() {
    wp_register_script('knockoutjs','http://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js');
    wp_enqueue_script('knockoutjs');
}
add_action('wp_enqueue_scripts','include_knockoutjs');

function include_indexjs() {
    wp_register_script('indexjs',get_stylesheet_directory_uri().'/js/index.js', array('jquery'), false, true);
    
    wp_enqueue_script('indexjs');
}
add_action('wp_enqueue_scripts','include_indexjs');

#enables the use of shortcodes in the widgets
add_filter('widget_text', 'do_shortcode');

#Let's add some search functionality
#add_action('pre_get_posts', 'filter_courses');

add_filter('relevanssi_modify_wp_query', 'filter_courses');
function filter_courses( $query) {
    //validate
    if (is_admin() || ! $query->is_main_query())
    {
        return $query;
    }


    if ( !is_page()) {

        $filter = array();

        //handle start dates
        // will show dates that are later than current date, unless start date is changed.
        if (isset($_GET['start_date']) && strtotime($_GET['start_date']) != -1) {
            $date = date('Ymd',strtotime($_GET['start_date']));
            $filter[] = array(
                'key' => 'start_date',
                'value' => $date,
                'compare' => '>='
            );
        } else {
            $date = date('Ymd',strtotime('now'));
            $filter[] = array(
                'key' => 'start_date',
                'value' => $date,
                'compare' => '>='
            );
        }

        //handle delivery method
        //will filter based upon whether delivery_method is "on" or not.
        if (isset($_GET['online'])) {
            $filter[] = array(
                'key' => 'delivery_method',
                'value' => '"Online"',
                'compare' => 'LIKE'
            );
        }
        if (isset($_GET['on-site'])){
            $filter[] = array(
                'key' => 'delivery_method',
                'value' => '"On-site"',
                'compare' => 'LIKE'
            );
        }
        if (isset($_GET['scheduled'])){
            $filter[] = array(
                'key' => 'delivery_method',
                'value' => '"Scheduled"',
                'compare' => 'LIKE'
            );
        }
        if (isset($_GET['on-demand'])){
            $filter[] = array(
                'key' => 'delivery_method',
                'value' => '"On-Demand"',
                'compare' => 'LIKE'
            );
        }

        //handle accreditation
        if (isset($_GET['accredited'])) {
            $filter[] = array(
                'key' => 'accredited',
                'value'=> 1
            );
        }

        //handle Credentials
        if (isset($_GET['ifma_credential']) && $_GET['ifma_credential'] === "fmp") {
            $query->set('cat', '6');
        }
        if (isset($_GET['ifma_credential']) && $_GET['ifma_credential'] === "sfp") {
            $query->set('cat', '7');
        }
        if (isset($_GET['ifma_credential']) && $_GET['ifma_credential'] === "cfm") {
            $query->set('cat', '8');
        }

    }


    $query->set('meta_query',$filter);

    return $query;
}

function my_the_post_action($post_object){
    echo "<pre> ". var_dump($post_object) . " </pre>";
}

add_action('the_post', 'my_the_post_action');
?>
