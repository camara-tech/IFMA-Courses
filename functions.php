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

#Let's add some search functionality

#using pre_get_posts
add_action('pre_get_posts', 'filter_courses');

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

#search using relevanssi
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

add_filter('relevanssi_hits_filter', 'relevanssi_filter_courses');

function relevanssi_filter_courses($hits) {
	global $wp_query;

	$results = array();
	foreach ($hits as $hit) {
		//start filtering by start date
		if (isset($wp_query->query_vars['start_date'])) {
			if (date(Ymd,strtotime($wp_query->query_vars['start_date'])) >= the_field('start_date',$hit)) {
				$results[] = $hit;
			}
		}		

		//check that the result matches the correct credential
		if (isset($wp_query->query_vars['ifma_credential'])) {
			if ($wp_query->query_vars['ifma_credential']==='fmp' && !in_category("fmp",$hit)) {
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
		if (isset($wp_query->query_vars['online']) && !in_array('online', get_field('delivery_method',$hit))) {
			array_pop($results);
			continue;
		} elseif (isset($wp_query->query_vars['on-site']) && !in_array('on-site',get_field('delivery_method',$hit))) {
			array_pop($results);
			continue;
		} elseif (isset($wp_query->query_vars['scheduled']) && !in_array('scheduled',get_field('delivery_method',$hit))) {
			array_pop($results);
			continue;
		} elseif (isset($wp_query->query_vars['on-demand']) && !in_array('on-demand',get_field('delivery_method',$hit))) {
			array_pop($results);
			continue;
		}
		// check accreditation
		if (isset($wp_query->query_vars['accredited']) && !get_field('accredited')) {
			array_pop($results);
			continue;
		}
		// provided by
		if (isset($wp_query->query_vars['provided_by']) && $wp_query->query_vars['provided_by'] != the_field('provided_by',$hit)) {
			array_pop($results);
			continue;
		}
	}
	return $hits;
}
?>
