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

#enables the use of shortcodes in the widgets
add_filter('widget_text', 'do_shortcode');

#Let's add some search functionality
add_action('pre_get_posts', 'filter_courses');

function filter_courses( $query) {
    //validate
    if (is_admin() || ! $query->is_main_query())
    {
        return $query;
    }


    if ( is_post_type_archive('course')) {

        $filter = array();


        //handle start dates


        //handle start dates
        // will show dates that are later than current date, unless start date is changed.



        if (isset($_GET['start_date']) && strtotime($_GET['start_date']) === -1) {
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
        $delivery_method = array();

        if (isset($_GET['online'])) {
            $delivery_method[] = 'Online';
        }
        if (isset($_GET['on-site'])){
            $delivery_method[] = 'On-site';
        }
        if (isset($_GET['scheduled'])){
            $delivery_method[]='Scheduled';
        }
        if (isset($_GET['on-demand'])){
            $delivery_method[]='On-Demand';
        }
    //echo '<pre> ';
    //print_r($delivery_method);
    //echo ' </pre>';
        if (count($delivery_method) > 0) {
            $filter[] = array(
                'key' => 'delivery_method',
                'value' => $delivery_method,
                'compare' => 'NOT IN'
            );
        }



        //handle accreditation

        //handle Credentials

        //handle zip code

    }



    echo '<pre> ';
    print_r($filter);
    echo ' </pre>';

    $query->set('meta_query',$filter);


    //echo '<pre> ';
    //print_r($query);
    //echo ' </pre>';

    return $query;
}
?>
