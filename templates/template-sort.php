 
    <?php

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
    } ?>
<div class="filters">
    <p class="pull-right">Sort By: <a href="?<?php echo http_build_query($query_string)?>&meta_key=start_date&orderby=meta_value_num">Date</a> | <a href="?<?php echo http_build_query($query_string)?>&meta_key=map_location&orderby=meta_value">Location</a> | <a href="?<?php echo http_build_query($query_string) ?>&orderby=title">A-Z</a></p>
</div>
<?php } ?>
