<div class="wrap">
  <h1>Braintrust Class Data Export</h1>
  <hr>
  <h2 style="margin-bottom:15px;">Attendee Export</h2>
  <?php
    $args = array(
      'posts_per_page'   => -1,
      'post_type'        => 'tribe_events',
      'post_status'      => 'publish',
      'orderby'          => 'meta_value',
      'order'            => 'ASC',
      'meta_key'         => '_EventStartDate'
    );
    $get_all_events = get_posts($args);
    if ($get_all_events) {
  ?>
    <form id="export-attendees-form" method="post" style="margin-bottom:25px;">
    <label for="export-attendee">Select a class to export the attendees in CSV format:</label><br>
    <select id="export-attendee" name="export_event_id" style="margin:5px 0 10px;">
    <?php
    foreach($get_all_events as $get_event) {
      $start_date = date(strtotime(get_post_meta($get_event->ID, '_EventStartDate', true)));
      $recent = strtotime('3 months ago');
      if ( $start_date > $recent ) {
        echo '<option value="' . $get_event->ID . '">' . date("M d, Y", $start_date) . ': ' . $get_event->post_title . '</option>';
      }
    }
    ?>
    </select><br>
    <button type="submit" name="braintrust-export-attendees" value="export" class="button-primary">Export Class Attendees</button>
    </form>
  <?php } ?>

  <hr>

  <h2 style="margin-bottom:15px;">Financials Export</h2>
  <?php
    $args = array(
      'posts_per_page'   => -1,
      'post_type'        => 'tribe_events',
      'post_status'      => 'publish',
      'orderby'          => 'meta_value',
      'order'            => 'ASC',
      'meta_key'         => '_EventStartDate'
    );
    $get_all_events = get_posts($args);
    if ($get_all_events) {
  ?>
    <form id="export-financials-form" method="post">
    <label for="export-financials">Select a class to export financial details in CSV format:</label><br>
    <select id="export-financials" name="export_event_id" style="margin:5px 0 10px;">
    <?php
    foreach($get_all_events as $get_event) {
      $start_date = date(strtotime(get_post_meta($get_event->ID, '_EventStartDate', true)));
      $recent = strtotime('6 months ago');
      if ( $start_date > $recent ) {
        echo '<option value="' . $get_event->ID . '">' . date("M d, Y", $start_date) . ': ' . $get_event->post_title . '</option>';
      }
    }
    ?>
    </select><br>
    <button type="submit" name="braintrust-export-financials" value="export" class="button-primary">Export Class Financials</button>
    </form>
  <?php } ?>

</div>