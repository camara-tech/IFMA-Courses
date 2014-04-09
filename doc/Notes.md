# PHP vs. Javascript

###Introduction
Here is my research of using PHP and Javascript to develop Wordpress themes. The problem I'm trying to solve is how to use the latest and greatest advances in Web Development with Javascript while having an elegant and graceful fall back to server-side PHP to handle requests when the latest Javascript is not available. 

###Initial Setup

I'm running the latest version of Wordpress with the following plugins, themes, and libraries.

- Wordpress Plugins
- Wordpress Themes
- Javascript Libraries

###Problem: searching/filtering the courses.

This is kind of the bread and butter of the site we are working to create. we will be filtering with the following fields:

- Course Provider (Drop-down field) (can only be done with javascript enabled)
- Start-Date (date field)
- Delivery Method (check boxes)
- College Accredited (true/false)
- IFMA Credential (Radio buttons)
- Location[zipcode?] (text box)


We will be sorting the results with the following fields

- Start-date
- number of CEUs
- Location distance

data model:

   
   ```
   course {
      course_provider => "algonquin college"
      start_date => 11242014
   }    

   searchform {
      course_providers=>{"algonquin college", "IFMA SCOE"}
      start_date=>current_date;
   }
   ```

How do we ensure that the provider drop-down is filled out?
