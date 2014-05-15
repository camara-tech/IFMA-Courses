<?php

//according to the wordpress codex, this is the default front-page for the website.

get_header();
get_template_part('template-part','head');
get_template_part('template-part','topnav');
?>

<?php get_sidebar('left');
get_template_part('template-part','search');

?>

<?php


get_footer();


 ?>
