<!-- search -->
<form role="search" action="/wordpress/" method="get" class="searchform">
<div class="search-form">
    <label class="screen-reader-text" for="s"><h2>Search Courses</h2></label><br />
    <input type="text" name="s" id="s" placeholder="Search Courses"/>
    <input type="submit" id="searchsubmit" value="Search" class="fa btn btn-default" />
</div>

<div class="facets">
<?php
$fields = get_field_objects(13);

foreach ($fields as $field):
  //handle date pickers
  if ($field['type'] === 'date_picker' && $field['name'] === 'start_date') {
      echo "<fieldset>";
      echo "<legend for='{$field['name']}'>{$field['label']}</legend>";
      echo "<label for ='{$field['name']}'>Date</label>";
      echo "<input type='date' name='{$field['name']}' value=", date("Y-m-d",strtotime("now")). " placeholder='{$field['display_format']}'\/>";
      echo "</fieldset>";

  // handle everything that is a checkbox
  } elseif ($field['type'] === 'checkbox') {
      echo "<fieldset>";
      echo "<legend for ='{$field['name']}'>{$field['label']}</legend>";
      foreach($field['choices'] as $choice_value=>$choice_label) {
          echo '<input type="checkbox" name="'.$choice_value.'" />';
          echo '<label for="'.$choice_value.'">'.$choice_label.'</label><br />';
      }
      echo "</fieldset>";

  // handle all the true/false fields
  } elseif ($field['type']==='true_false') {
      echo "<div class=true_false>";
      echo '<input type="checkbox" name="'.$field['name'].'" id="'.$field['name'].'" />';
      echo "<label for ='{$field['name']}'>{$field['label']}</label>";
      echo "</div>";


  //handle the category fields
  } elseif ($field['type']==='taxonomy' && $field['taxonomy']==='category'){
      $categories = get_categories(array('orderby'=>'id'));
      echo "<fieldset>";
      echo "<legend for='{$field['name']}'>{$field['label']}</legend>";
      echo "<input type='radio' name='{$field['name']}'value='all'> All </input><br />";
      foreach ($categories as $category) {

          if (isset($_GET['ifma_credential']) && $_GET['ifma_credential'] === $category->slug) {
              echo "<input type='radio' value='$category->slug' name='{$field['name']}' checked='true'>";
          } else {
              echo "<input type='radio'' value='$category->slug' name='{$field['name']}'>";
          }
          echo "<label for=".$category->slug.">".$category->name."</label><br />";

      }
  }
endforeach;
?>
</div>
<div class="filters">
    <p>Sort By: <a href="#">Date</a> | <a href="#">Location</a> | <a href="#">A-Z</a></p>
</div>

</form>	

