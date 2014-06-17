<!-- search -->
<form role="search" action="<?php echo home_url('/'); ?>" method="get" class="searchform col-lg-4 col-md-4">


<div class="search-term">
    <h2> Search Courses</h2> 
    <label class="screen-reader-text" for="s">By Keyword(s)</label>
    <input type="text" name="s" id="s" />
</div>

<div class="facets">
<h3>Advanced Search</h3>
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
      echo "<label for='{$field['name']}'>Month</label>";
      echo "<select name='{$field['name']}[month]'>";

?> 
        <option>January</option>
`       <option>February</option>
        <option>March</option>
        <option>April</option>
        <option>May</option>
        <option>June</option>
        <option>July</option>
        <option>August</option>
        <option>September</option>
        <option>October</option>
        <option>November</option>
        <option>December</option>
<?php 
      echo "</select>";
      echo "<label for='{$field['name']}'>Year</label>";
      echo "<select name='{$field['name']}[year]'>";
?>
    <option>2014</option>
    <option>2015</option>
    <option>2016</option>
    <option>2017</option>
    
<?php
      echo "</select>";
      echo "</div>";
  }
}

  // handle everything that is a checkbox
foreach ($fields as $field){
  if ($field['type'] === 'checkbox') {
      echo "<div class='facet-checkbox'>";
      foreach($field['choices'] as $choice_value=>$choice_label) {
          echo "<label for='{$choice_value}'>$choice_label</label>"; 
          if (isset($_GET['delivery_method']) && $_GET['delivery_method'] === $choice_value) {
          echo "<input type='checkbox' name='{$field['choices']}' id='{$choice_value}' checked='true' />";
          } else {
          echo "<input type='checkbox' name='{$field['choices']}' id='{$choice_value}' />";
          }
      }
      echo "</div>";
  }
}

  // handle all the true/false fields
foreach ($fields as $field){
  if ($field['type']==='true_false') {
      echo "<div class=facet-true_false>";
      echo "<label for ='{$field['name']}'>{$field['label']}</label>";
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
      echo "<label for={$field['name']}>{$field['label']}</label>";
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

    <input type="submit" id="searchsubmit" value="View Results" class="btn btn-default" />

</form>
