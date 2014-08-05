<!-- search -->
<form role="search" action="<?php echo home_url('/'); ?>" method="get" class="searchform col-lg-4 col-md-4 col-sm-4">


<div class="search-term">
    <h2> Search Courses</h2>
    <label class="screen-reader-text" for="s">By Keyword(s)</label>
    <?php
    if (isset($_GET['s'])){ ?>
        <input type="text" name="s" id="s" value="<?php echo $_GET['s']; ?>">
    <?php } else { ?>
        <input type="text" name="s" id="s" />
    <?php } ?>

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

  // handle everything that is a checkbox
foreach ($fields as $field){
  if ($field['type'] === 'checkbox') {
      echo "<div class='facet-checkbox'>";
      foreach($field['choices'] as $choice_value=>$choice_label) {
          if (isset($_GET[$choice_value]) && $_GET[$choice_value] === "on") {
          echo "<input type='checkbox' name='{$choice_value}' id='{$choice_value}' checked='true' />";
          } else {
          echo "<input type='checkbox' name='{$choice_value}' id='{$choice_value}' />";
          }
          echo "<label for='{$choice_value}'>$choice_label</label>";
      }
      echo "</div>";
  }
}

// handle date pickers
foreach ($fields as $field){
  if ($field['type'] === 'date_picker' && $field['name'] === 'start_date') {
      echo "<div class='facet-date'>";
      echo "<label for='{$field['name']}'>Month</label>";
      echo "<select name='{$field['name']}[month]'>";

            if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "January"){?>
            <option selected>January</option>
        <?php } else{ ?>
            <option>January</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "February"){?>
            <option selected>February</option>
        <?php } else{ ?>
            <option>February</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "March"){?>
            <option selected>March</option>
        <?php } else{ ?>
            <option>March</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "April"){?>
            <option selected>April</option>
        <?php } else{ ?>
            <option>April</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "May"){?>
            <option selected>May</option>
        <?php } else{ ?>
            <option>May</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "June"){?>
            <option selected>June</option>
        <?php } else{ ?>
            <option>June</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "July"){?>
            <option selected>July</option>
        <?php } else{ ?>
            <option>July</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "August"){?>
            <option selected>August</option>
        <?php } else{ ?>
            <option>August</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "September"){?>
            <option selected>September</option>
        <?php } else{ ?>
            <option>September</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "October"){?>
            <option selected>October</option>
        <?php } else{ ?>
            <option>October</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "November"){?>
            <option selected>November</option>
        <?php } else{ ?>
            <option>November</option>
        <?php } ?>
        <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['month'] === "December"){?>
            <option selected>December</option>
        <?php } else{ ?>
            <option>December</option>
        <?php }

      echo "</select>";
      echo "<label for='{$field['name']}'>Year</label>";
      echo "<select name='{$field['name']}[year]'>";
?>
    <?php if(isset($_GET[$field['name']]) && $_GET[$field['name']]['year'] === "2014"){?>
        <option selected>2014</option>
    <?php } else{ ?>
        <option>2014</option>
    <?php }
     if(isset($_GET[$field['name']]) && $_GET[$field['name']]['year'] === "2015"){?>
        <option selected>2015</option>
    <?php } else{ ?>
        <option>2015</option>
    <?php }
    if(isset($_GET[$field['name']]) && $_GET[$field['name']]['year'] === "2016"){?>
        <option selected>2016</option>
    <?php } else{ ?>
        <option>2016</option>
    <?php }
     if(isset($_GET[$field['name']]) && $_GET[$field['name']]['year'] === "2017"){?>
        <option selected>2017</option>
    <?php } else{ ?>
        <option>2017</option>
    <?php }

      echo "</select>";
      echo "</div>";
  }
}


  // handle all the true/false fields
foreach ($fields as $field){
  if ($field['type']==='true_false') {
      echo "<div class=facet-true_false>";
      if (isset($_GET[$field['name']]) && $_GET[$field['name']]==='on'){
          echo '<input type="checkbox" name="'.$field['name'].'" id="'.$field['name'].'" checked="true" />';
      } else {
      echo '<input type="checkbox" name="'.$field['name'].'" id="'.$field['name'].'" />';
      }
      echo "<label for ='{$field['name']}'>{$field['label']}</label>";


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
