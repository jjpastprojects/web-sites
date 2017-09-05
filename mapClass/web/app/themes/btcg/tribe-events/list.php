<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

do_action( 'tribe_events_before_template' );

?>

<div class="classes-index" ng-app="braintrust" ng-controller="ClassesCtrl as ctrl">

  <section class="classes-index__top">
    <div class="row">
      <div class="small-12 large-push-8 large-4 columns">
        <div class="classes-index__intro">
          <h2>Headline about classes here</h2>
          <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna mollis ornare vel eu leo. Nulla vitae elit libero, a pharetra augue. Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <h3>Not sure which class is right for you?</h3>
          <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna mollis ornare vel eu leo. Nulla vitae elit libero, a pharetra augue. Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <a href="#" class="button">Class Catalogue</a>
        </div>
      </div>
      <div class="small-12 large-pull-4 large-8 columns">
        <?php include('list/map.php'); ?>
      </div>
    </div>
  </section>

  <hr>

  <section class="class-search">
    <div class="row">
      <div class="small-11 small-centered medium-uncentered medium-6 columns">
        <?php include('filters/date.php'); ?>
      </div>
      <div class="small-9 small-centered medium-uncentered medium-6 columns">
        <?php include('filters/locations.php'); ?>
      </div>
    </div>
    <div class="row">
      <div class="small-10 small-centered columns">
        <hr>
        <?php include('filters/categories.php'); ?>
      </div>
    </div>
  </section>

  <div class="row">

    <hr>

    <div class="column">
      <?php include('list/table.php'); ?>
    </div>
  </div>

</div> <!--/.classes-index-->

<?php

do_action( 'tribe_events_after_template' );
