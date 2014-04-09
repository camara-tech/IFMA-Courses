<form action="" method="get" class="filter-archive">
    <form action="/wordpress/course" method="get" class="course-form">
  <div>
    <label for="start_date">Start Date</label>
    <input type="date" name="start_date" placeholder="April 7, 2015" />
  </div>
  <div>
      <fieldset>
          <legend>Delivery Method</legend>

          <label for="online">Online</label>
          <input type="checkbox" name="online" id="online" />

          <label for="on-site">On-Site</label>
          <input type="checkbox" name="on-site" id="on-site" />

          <label for="scheduled">Scheduled</label>
          <input type="checkbox" name="scheduled" id="scheduled" />

          <label for="on-demand">On-Demand</label>
          <input type="checkbox" name="on-demand" id="on-demand" />
      </fieldset>
  </div>

  <div>
    <fieldset>
        <legend>Accredited</legend>

        <label for="yes">Yes</label>
        <input type="radio" name="accredited" value="yes"/>

        <label for="no">No</label>
        <input type="radio" name="accredited" value="no"/>

        <label for="both">Either</label>
        <input type="radio" name="accredited" value="either"/>
    </fieldset>
  </div>

  <div>
    <fieldset>
        <legend>Credentials</legend>

        <label for="FMP">Facility Management Professional</label>
        <input type="radio" name="credential" value="FMP"/>

        <label for="SFP">Sustainability Facility Professional</label>
        <input type="radio" name="credential" value="SFP"/>

        <label for="CFM">Certified Facility Manager</label>
        <input type="radio" name="credential" value="CFM"/>
    </fieldset>
  </div>

  <input type="Submit" value="Search">

</form>


<?php
//if (isset($_GET['start_date']))
//        echo '"'.$_GET['start_date'].'"<br>';
//        echo '"'.strval($_GET['start_date']).'"<br>';
//        if (strtotime(strval($_GET['start_date'])) === false || strtotime(strval($_GET['start_date'])) === -1) {
//            echo "can't convert to date format <br>";
//        } else {
//            echo '"'.strtotime(strval($_GET['start_date'])).'"<br>';
//        }
//        echo '"'.date('Ymd',strtotime(strval($_GET['start_date']))).'"';
?>
