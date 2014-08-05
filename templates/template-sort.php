<?php

global $wp_query;
if (!is_single()) {
    //make sure to cleanup the URL, so that we don't unecessarily increase the size of the query string
    parse_str($_SERVER['QUERY_STRING'],$query_string);
    if (isset($_GET['orderby'])) {
        unset($query_string['orderby']);
    }

    if (isset($_GET['meta_key'])) {
    unset($query_string['meta_key']);
    }

    if (isset($_GET['meta_value'])) {
    unset($query_string['meta_value']);
    }

    if (isset($_GET['order'])) {
        if ($_GET['order'] == "ASC"){
            $query_string['order'] = "DESC";
        } else {
            $query_string['order'] = "ASC";
        }
    } else {
        $query_string['order'] = "ASC";
    }

}
    ?>
<div class="filters">
    <p class="pull-left"><?php echo $wp_query->found_posts; ?> Courses found</p>
    <p class="pull-right">Sort By:
        <a href="?<?php echo http_build_query($query_string)?>&meta_key=start_date&orderby=meta_value_num">Date</a> <?php if ($query_string['order'] == "ASC"){ echo "<i class='fa fa-sort-desc'></i>"; } else { echo "<i class='fa fa-sort-asc'></i>"; }?> |
        <a href="?<?php echo http_build_query($query_string)?>&meta_key=map_location&orderby=meta_value">Location</a> <?php if ($query_string['order'] == "ASC"){ echo "<i class='fa fa-sort-desc'></i>"; } else { echo "<i class='fa fa-sort-asc'></i>"; }?> |
        <a href="?<?php echo http_build_query($query_string) ?>&orderby=title">A-Z</a><?php if ($query_string['order'] == "ASC"){ echo "<i class='fa fa-sort-desc'></i>"; } else { echo "<i class='fa fa-sort-asc'></i>";} ?></p>
</div>
