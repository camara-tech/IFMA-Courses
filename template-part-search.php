<!-- search -->
<form role="search" action="/wordpress/" method="get" class="searchform">
<div class="search">
    <label class="screen-reader-text" for="s">Search Courses:</label>
    <input type="text" name="s" id="s" placeholder="Search Courses"/>
    <input type="submit" id="searchsubmit" value="Search" />
</div>

<?php
$fields = get_field_objects(13);

foreach ($fields as $field):
  //handle date pickers
  if ($field['type'] === 'date_picker') {
      echo "<label for ='{$field['name']}'>{$field['label']}</label>";
      echo "<input type='date' name='{$field['name']}' value=", strtotime("now"). " placeholder='{$field['display_format']}'\/>";

  // handle everything that is a checkbox
  } elseif ($field['type'] === 'checkbox') {
      echo "<label for ='{$field['name']}'>{$field['label']}</label>";
      echo '<select name="'.$field['name'].'" id="'.$field['name'].'" multiple>';
      foreach($field['choices'] as $choice_value=>$choice_label) {
          echo '<option value="'.$choice_value.'">'.$choice_label.'</option>';
      }
      echo '</select>';

  // handle all the true/false fields
  } elseif ($field['type']==='true_false') {
      echo "<label for ='{$field['name']}'>{$field['label']}</label>";
      echo '<input type="checkbox" name="'.$field['name'].'" id="'.$field['name'].'" />';

  //handle the category fields
  } elseif ($field['type']==='taxonomy' && $field['taxonomy']==='category'){
      $categories = get_categories(array('orderby'=>'id'));
      echo "<label for ='{$field['name']}'>{$field['label']}</label>";
      echo '<select name="'.$field['name'].'" id="'.$field['name'].'">';
      foreach ($categories as $category) {
          echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
      }
      echo '</select>';
  }
endforeach;
?>
</form>	

