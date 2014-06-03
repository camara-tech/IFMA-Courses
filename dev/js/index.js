//replace the courses link with the following if Javascript is working
// "/wordpress/api/get_posts/?post_type=course"

jQuery("a[title='Courses']").attr("href",'/wordpress/api/get_posts/?post_type=course');

jQuery("#searchsubmit").click(function(event){
   jQuery(".facets").removeClass(".first-search");
   jQuery(".filters").removeClass(".first-search");
});

function process($courses) {
    $courses = $courses.feed.entry;
    
    var $course_info = [{}];
    var $location_info = {};
    var $instructor_info = {};
   for (var i = 0; i < $courses.length; i++) {
       $course_info[i].name = $courses[i].gsx$courses;
       $course_info[i].description = $courses[i].gsx$contactfname;

/*       $course_info[i].providedby = $courses[i]
       $course_info[i].startdate
       $course_info[i].enddate
       $course_info[i].deliverymethod
       $course_info[i].websiteurl
       $course_info[i].registrationurl
       $course_info[i].collegeaccredited
       $course_info[i].credential
       $course_info[i].ceu
       $course_info[i].level	
       $course_info[i].location
       $course_info[i].instructor
       $course_info[i].contactfirstname
       $course_info[i].contactlastname
       $course_info[i].contactemail
       $course_info[i].contacttelephone       
       
       $location_info[i].country = 
       $location_info[i].state
       $location_info[i].city
       $location_info[i].street
       $location_info[i].zipcode
       $location_info[i].latitude
       $location_info[i].longitude
       
       $instructor_info[i].firstname
       $instructor_info[i].lastname
       $instructor_info[i].email
       $instructor_info[i].phonenumber
       $instructor_info[i].certifications
       $instructor_info[i].degrees
       $instructor_info[i].firstname
       $instructor_info[i].firstname
       $instructor_info[i].firstname
       $instructor_info[i].firstname
       $instructor_info[i].firstname
       
 */      
   }
    
}
