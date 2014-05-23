<!-- search -->
<form role="search" action="/" method="get" class="searchform">
<div class="search-form">
    <label class="screen-reader-text" for="s"><h2>Search Courses</h2></label><br />
    <input type="text" name="s" id="s" placeholder="What would you like to learn today?"/>
    <input type="submit" id="searchsubmit" value="Go" class="fa btn btn-default" />
</div>

<div class="facets">
<?php
$fields = get_field_objects(13);

foreach ($fields as $field):
  //handle date pickers
  if ($field['type'] === 'date_picker' && $field['name'] === 'start_date') {
      echo "<div class='facet-date'>";
      echo "<label for ='{$field['name']}'>{$field['label']}</label><br />";
      echo "<input type='date' name='{$field['name']}' value=", date("Y-m-d",strtotime("now")). " placeholder='{$field['display_format']}'\/>";
      echo "</div>";

  // handle everything that is a checkbox
  } elseif ($field['type'] === 'checkbox') {
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

  // handle all the true/false fields
  } elseif ($field['type']==='true_false') {
      echo "<div class=facet-true_false>";
      echo "<label for ='{$field['name']}'>{$field['label']}</label><br />";
      if (isset($_GET[$field['name']]) && $_GET[$field['name']]==='on'){
          echo '<input type="checkbox" name="'.$field['name'].'" id="'.$field['name'].'" checked="true" />';
      } else {
      echo '<input type="checkbox" name="'.$field['name'].'" id="'.$field['name'].'" />';
      }

      echo "</div>";


  //handle the category fields
  } elseif ($field['type']==='taxonomy' && $field['taxonomy']==='category'){
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
endforeach;
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

