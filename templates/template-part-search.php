<!-- search -->
<form role="search" action="<?php echo home_url('/'); ?>" method="get" class="searchform">

<div class="search-form">
    <label class="screen-reader-text" for="s"><h2>Search Courses</h2></label><br />
    <input type="text" name="s" id="s" placeholder="What would you like to learn today?"/>
    <input type="submit" id="searchsubmit" value="Go" class="btn btn-default" />
</div>

<div class="facets">
<?php

//this theme requires Advanced custom fields...until I can get a plugin working.

//first we need to pull all ACF groups
$acf = get_posts(array('post_type' => 'acf'));
// then we need to grab acf_courses
foreach ($acf as $group) {
    if ($group->post_name == 'acf_courses') {
    $acf_group_ID = $group->ID;
    }
}

// all the information is stored in the meta fields
$acf_group_meta = get_post_meta($acf_group_ID);

$fields = array();
// make sure we don't have any extraneous information
foreach($acf_group_meta as $meta_field) {
                //the keys we are looking for all start with field_
                if (substr_compare(key($meta_field),'field_',0,6)){
                $fields[] = unserialize($meta_field[0]);

                }
            }
// now we have the ACF fields directly from ACF itself.

// make sure that we have this laid out the way we want. rather than relying upon the order of the data for the layout.

// handle date pickers
foreach ($fields as $field){
  if ($field['type'] === 'date_picker' && $field['name'] === 'start_date') {
      echo "<div class='facet-date'>";
      echo "<label for ='{$field['name']}'>{$field['label']}</label><br />";
      echo "<input type='date' name='{$field['name']}' value=", date("Y-m-d",strtotime("now")). " placeholder='{$field['display_format']}'\/>";
      echo "</div>";
  }
}

  // handle everything that is a checkbox
foreach ($fields as $field){
  if ($field['type'] === 'checkbox') {
      echo "<div class='facet-checkbox'>";
      echo "<label for ='{$field['name']}'>{$field['label']}</label><br />";
      echo "<select name={$field['name']} id={$field['name']} multiple='true'>";
      foreach($field['choices'] as $choice_value=>$choice_label) {
          if (isset($_GET['delivery_method']) && $_GET['delivery_method'] === $choice_value) {
          echo "<option value='$choice_value' selected='selected'>$choice_label</option>";
          } else {
          echo "<option value='$choice_value'>$choice_label</option>";
          }
      }
      echo '</select>';
      echo "</div>";
  }
}

  // handle all the true/false fields
foreach ($fields as $field){
  if ($field['type']==='true_false') {
      echo "<div class=facet-true_false>";
      echo "<label for ='{$field['name']}'>{$field['label']}</label><br />";
      if (isset($_GET[$field['name']]) && $_GET[$field['name']]==='on'){
          echo '<input type="checkbox" name="'.$field['name'].'" id="'.$field['name'].'" checked="true" />';
      } else {
      echo '<input type="checkbox" name="'.$field['name'].'" id="'.$field['name'].'" />';
      }

      echo "</div>";
  }
}


  //handle the category fields
foreach ($fields as $field){
  if ($field['type']==='taxonomy' && $field['taxonomy']==='category'){
      $categories = get_categories(array('orderby'=>'id'));
      echo "<div class='facet-category'>";
      echo "<label for={$field['name']}>{$field['label']}</label><br />";
      echo "<select name={$field['name']} id={$field['name']}>";
      echo "<option value='all'>All</option>";
      foreach ($categories as $category) {
          if (isset($_GET['ifma_credential']) && $_GET['ifma_credential'] === $category->slug) {
              echo "<option value=$category->slug selected='selected'>$category->name</option>";
          } else {
              echo "<option value=$category->slug >$category->name</option>";
          }
      }
      echo "</select>";
    echo "</div>";

  }
}
?>
</div>

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
    <p>Sort By: <a href="?<?php echo http_build_query($query_string)?>&meta_key=start_date&orderby=meta_value_num">Date</a> | <a href="?<?php echo http_build_query($query_string)?>&meta_key=map_location&orderby=meta_value">Location</a> | <a href="?<?php echo http_build_query($query_string) ?>&orderby=title">A-Z</a></p>
</div>
<?php } ?>

</form>
