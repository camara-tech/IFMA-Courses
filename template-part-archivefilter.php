<?php $fields=get_field_objects(13);?>
<!-- <pre>
    <?php print_r ($fields)?>
</pre> -->
<form action="/wordpress/course" method="get" class="course-form">
    <?php foreach ($fields as $field): ?>

    <!-- handle the date pickers -->
    <?php if ($field[ 'type']==='date_picker' ){ ?>
    <fieldset>
        <label for="<?php echo $field['name']; ?>">
            <?php echo $field[ 'label']; ?>
        </label>
        <input type="date" name="<?php echo $field['name']; ?>" placeholder='<?php echo $field['display_format']; ?> ' />
    </fieldset>
    <?php } ?>

    <!-- handle everthing that is a checkbox -->
    <?php if ($field[ 'type']==='checkbox' ) { ?>
    <fieldset>
        <legend>
            <?php echo $field['label']?>
        </legend>
        <?php foreach ($field['choices'] as $choice_value=>$choice_label){ ?>
        <label for="<?php echo $choice_value; ?>">
            <?php echo $choice_label; ?>
        </label>
        <input type="checkbox" name="<?php echo $choice_value; ?>" id="<?php echo $choice_value; ?>" />
        <?php } ?>
    </fieldset>
    <?php } ?>

    <!-- handle all the True/False fields -->

    <?php if ($field[ 'type']==='true_false' ){ ?>

    <fieldset>
        <label for='<?php echo $field[' name ']; ?>'>
            <?php echo $field[ 'label']; ?>
        </label>
        <input type="checkbox" name="<?php echo $field['name']; ?>" id="<?php echo $field['name'];?>" />
    </fieldset>

    <?php } ?>

    <!-- handle the category fields -->
    <?php if ($field[ 'type']==='taxonomy' && $field[ 'taxonomy']==='category' ){ ?>

    <?php $categories = get_categories(array( 'orderby'=>'id')); ?>

    
    <fieldset>
        <legend>
            <?php echo $field[label];?>
        </legend>
        <?php foreach ($categories as $category) { ?>
        <label for="<?php echo $category->slug; ?>">
            <?php echo $category->name; ?></label>
        <input type="radio" name="<?php echo $field['name']; ?>" value="<?php echo $category->slug; ?>" />
        <?php } ?>
    </fieldset>
    <?php } ?>

    <?php endforeach; ?>
    <input type="Submit" value="Search">

</form>
<?php
echo strtotime($_GET['start_date']);
if (isset($_GET['start_date']) && strtotime($_GET['start_date']) != -1) {
echo date('Ymd',strtotime($_GET['start_date']));
}

?>
