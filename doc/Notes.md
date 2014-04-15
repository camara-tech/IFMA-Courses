# Courses and Instructors
###Thoughts:
Project should develop as follows:

1. What are the content types?
2. What are the fields which compose those content types?
3. What are all the different ways in which those content types will be presented to the user?
4. What are the HTML/CSS elements we are going to use?
5. How are those elements built into components?
6. How do those components fit into a layout?

The information 

This is going to be done on Wordpress.

Installed four plugins:

* [Custom Post UI](http://wordpress.org/plugins/custom-post-type-ui/)
* [Advanced Custom Fields](http://wordpress.org/plugins/advanced-custom-fields/)
* [User Role Editor](http://wordpress.org/plugins/user-role-editor/)
* [JSON API](http://wordpress.org/plugins/json-api/)

installed theme:

* [DevDMBoostrap3](http://wordpress.org/themes/devdmbootstrap3)

IFMA Courses Providers

* https://spreadsheets.google.com/feeds/list/0AiPlJSl26UE7dDJ5anJWS2VYRFIzb3pLMXJiUXhEdUE/od6/public/values?alt=json-in-script&callback=process

SFP Courses

* https://spreadsheets.google.com/feeds/list/0AiPlJSl26UE7dFZpZXpoQ254WThjWnJDRGFPLUJqWGc/od6/public/values?alt=json-in-script&callback=process

---
### Content types

For this system we will have three different content types:

1. Courses
2. Instructors
3. Locations

All of these have various information attached to them

In "IFMA-Courses-Providers" and "IFMA - SFP Courses", we have the following information:

- School Name
- Course name
- Latitude
- Longitude
- Country
- State
- City
- Contact First Name
- Contact Last name
- Email
- Phone number
- URL
- Description (probably for the Google Maps InfoWindow)
- Course Location
- Start Date
- Notes

Based upon my notes and our emails, we also need to know the following information.

- University/College accreditation
- Level (100,200,300)
- CEU (and if so # of CEU)
- Provided By

These different fields of information could be categorized as follows:(pulling from the IFMA.org events calendar)

- Course Information
    - Course Name
    - Course Description(the html should be generated client-side...this is 2014, even IE 7 can do this)
    - Provided By
    - Start Date
    - End Date
    - Delivery method - online, on-site, scheduled, on demand,etc.
    - possibly an image?
    - Website URL/Register link
    - College Accredited (yes or no)
    - Credential (is it FMP, SFP, CFM?)
    - Has CEU
        - number of CEU
    - Level
- Location (offer the ability to lookup/autofill the information?)
	- Full Address
    	- Country
        - State/Province (if applicable)
        - City
        - Street
        - Zip code/postal code (if applicable)
    - Latitude
    - Longitude
    - School/Building Name
- Instructor (Are the instructors different from the contacts?)
    - Contact/Instructor First name
    - Contact/Instructor Last name
    - Email
    - Phone number
    - Certifications ?
    - Degrees ?

---

### Questions:

- Are we going to have a welcome page or are we going have them go straight into searching for courses?
- are we sticking with the current ifma theme, the third-party theme, or something else?
- will we need the micro_nav bar?
- Is this a site all by itself, or is it supposed to be integrated with a certain section of the site?
- Am I supposed to be developing this on my own, or should I be working with Aron in developing the Wordpress themes?
- How long till I can get access to a server to put this up for others to review?
- what is the actual deadline for this project? It was originally going to be launched by Facility Fusion DC, but last time I checked, it was pushed till afterward.

---
###Notes:
####From March 13, 2014

CEU UX -> Improve User navigation

Instructors -> a way to manage instructors

Courses -> a way to manage all of the different courses

Virtual Courses?

####From March 24, 2014

Something to remember is the keep University courses distinguished between accredited and non-accredited.

####From March 28,2014
SFP Courses -> course page w/ instructors

####From March 31,2014
Alettia sends me an email asking how the development is going...I'm so far behind!.

Worked out the overall structure and layout of the site. I'm going to stick to the look and feel that we gave to our third party sites, though, if I find any holes, I'll be sure to fill them in.


####From April 1, 2014
April Fools!

-> put in the plugins that will make filling in the Database super simple (just add the fields and you're done!)

-> Figured out where to put the hook to pull the data to the front end, now I just need to figure out how I'm going to pull the data into a sensible html/css markup system that JUST MAKES SENSE

####From April 2, 2014
Trying to figure out how to use the recommended fonts from the IFMA Branding guidelines is driving me crazy!, should Web make sure that we have a license to use the fonts that are set in the guidelines? if not, who has the say as to which fonts we are allowed to use? (I'm going to use the default Bootstrap fonts for now.)

I like the overall look and feel of the edX website, so I think I'm going to be imitating their style of listing images. 

I'm going to put in the different SFP courses, and see What happens when I have all that data in. If everything looks good at that point, then I'll go ahead and bring in the rest of the data and then finish up with some AWESOME tweaks.

#### From April 10, 2014
Been too busy to update documentation of previous days, will do quick dump. Figured out how to retrieve all the information I need from the database and format it. emailed other members about the different fields, implemented the changes mentioned by Alettia for the information and update the documentation to reflect those changes. implemented a search form that filters for credential type, accreditation, start date, and delivery method. not 100% sure of what theme I'm supposed to be using, and the kind of content. Need to send out an update about the fields as they currently stand.

#### From April 11, 2014
Update the form to dynamically add and remove fields that can be sorted by if fields are added or removed from the backend.

#### from April 15, 2014
figured out how to pull the course information as JSON data, so that I can pull it into any major Javascript MVC framework. I'm leaning toward Knockout since I know that once best, (and I've already built a frontend similar to what we are looking at). but I might want to look at backbone, ember, or angular...depending on whether we have enough time. 