//replace the courses link with the following if Javascript is working
// "/wordpress/api/get_posts/?post_type=course"

jQuery("a[title='Courses']").attr("href",'/wordpress/api/get_posts/?post_type=course');

jQuery("#searchsubmit").click(function(event){
   jQuery(".facets").removeClass(".first-search")
   jQuery(".filters").removeClass(".first-search")
});
