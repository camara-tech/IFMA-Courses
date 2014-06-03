<?php
#let's make sure that the bootstrap font-awesome system is included
function include_font_awesome() {
	wp_register_style('font-awesome.css', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
	wp_enqueue_style('font-awesome.css');
}
add_action('wp_enqueue_scripts','include_font_awesome');

function include_indexjs() {
	wp_register_script('indexjs',get_stylesheet_directory_uri().'/js/index.js', array('jquery'), false, true);

	wp_enqueue_script('indexjs');
}
add_action('wp_enqueue_scripts','include_indexjs');


# let's modify the admin menu

add_action('admin_menu','remove_default_post_type');

function remove_default_post_type() {
  if (current_user_can('manage_options') === false) {
  remove_menu_page('edit.php');
  remove_menu_page('edit.php?post_type=page');
  remove_menu_page('edit-comments.php');
  remove_menu_page('themes.php');
  remove_menu_page('plugins.php');
  remove_menu_page('tools.php');
  remove_menu_page('options-general.php');
  remove_menu_page('users.php');
  }
  
}

add_action('wp_before_admin_bar_render', 'modify_admin_bar');

function modify_admin_bar(){
  if (current_user_can('manage_options') === false) {
  global $wp_admin_bar;
    $wp_admin_bar->remove_menu('new-post');
  $wp_admin_bar->remove_menu('new-page');
  }

}


# a helper function

function walk_delivery_method($value,$key) {
                if ($key == 0) {
                    echo $value;
                } else {
                    echo ", ".$value;
                }
}
#Let's add some search functionality
#
# first make sure that the query vars for the filters  are available to relevanssi
add_filter('query_vars', 'relevanssi_qvs');

function relevanssi_qvs($qv) {
	array_push($qv, 'start_date');
	array_push($qv, 'ifma_credential');
	array_push($qv, 'online');
	array_push($qv, 'on-site');
	array_push($qv, 'scheduled');
	array_push($qv, 'on-demand');
	array_push($qv, 'accredited');
	array_push($qv, 'provided_by');
	return $qv;

}


#second, make sure that relevanssi fires if a filter is present but the search term is empty
#
#currently only tests if ifma_credential or start_date is present

add_filter('relevanssi_search_ok', 'search_trigger');

function search_trigger($search_ok){
	global $wp_query;
	if (!empty($wp_query->query_vars['ifma_credential']) || !empty($wp_query->query_vars['start_date'])){
		$search_ok = true;
	}
	return $search_ok;
}

#now handle the relevanssi search, filtering if necessary
#

add_filter('relevanssi_hits_filter', 'filter_courses');

function filter_courses($hits) {
	global $wp_query;

	// just make sure that we have some results to work with:
	if ($hits[0] == null) {
    // no search hits, so return all
    $args = array( 'post_type' => 'course' );
    $hits[0] = get_posts($args);
    }

   // now filter the results
   	$results = array();
		foreach ($hits[0] as $hit) {
			//start filtering by start date and if no date is specified use current date.

			if (isset($wp_query->query_vars['start_date']) && get_field('start_date',$hit->ID) != null) {
				if (date(Ymd,strtotime($wp_query->query_vars['start_date'])) >= date(Ymd,get_field('start_date',$hit->ID))) {
					$results[] = $hit;
				}
			} else {

				if (date(Ymd,strtoTime('now')) >= date(Ymd,get_field('start_date',$hit->ID))) {
					$results[] = $hit;
				}

			}		

			//check that the result matches the correct credential
			if (isset($wp_query->query_vars['ifma_credential'])) {
				if ($wp_query->query_vars['ifma_credential']==='fmp' && !in_category('fmp',$hit)) {
					array_pop($results);
					continue;
				} 
				elseif ($wp_query->query_vars['ifma_credential']==='sfp'&& !in_category('sfp',$hit)) {
					array_pop($results);
					continue;
				}	
				elseif ($wp_query->query_vars['ifma_credential']==='cfm' && !in_category('cfm',$hit)) {
					array_pop($results);
					continue;
				}
			}
			// remove those without the specified delivery method		
			if (isset($wp_query->query_vars['online']) && !in_array('online', get_field('delivery_method',$hit->ID))) {
				array_pop($results);
				continue;
			} elseif (isset($wp_query->query_vars['on-site']) && !in_array('on-site',get_field('delivery_method',$hit->ID))) {
				array_pop($results);
				continue;
			} elseif (isset($wp_query->query_vars['scheduled']) && !in_array('scheduled',get_field('delivery_method',$hit->ID))) {
				array_pop($results);
				continue;
			} elseif (isset($wp_query->query_vars['on-demand']) && !in_array('on-demand',get_field('delivery_method',$hit->ID))) {
				array_pop($results);
				continue;
			}
			// check accreditation
			if (isset($wp_query->query_vars['accredited']) && !get_field('accredited',$hit->ID)) {
				array_pop($results);
				continue;
			}
			// provided by
			if (isset($wp_query->query_vars['provided_by']) && $wp_query->query_vars['provided_by'] != the_field('provided_by',$hit->ID)) {
				array_pop($results);
				continue;
			}
		}
        $hits[0] = $results;
	return $hits;
}

?>
