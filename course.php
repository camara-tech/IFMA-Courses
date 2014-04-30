<?php

/**
 * Class Course
 * @author Jonathan Camara
 */
class CourseItem
{
	private $id;
	private $slug;
	private $title;
	private $content;
	private $excerpt;
	private $categories;
	private $instructor;
	private $location;
	private $start_date;
	private $provided_by;
	private $level;
	private $ceu;
	

	function __construct($course)
	{
		$this->$id = $course['id'];
		$this->$slug = $course['slug'];
		$this->$title = $course['title'];
		$this->$content = $course['content'];
	}
	
}

?>
