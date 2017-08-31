<?php if($campaign && !$campaign->over):?>
  <div class="row">
    <div class="col-lg-5 col-md-6 col-sm-8 col-lg-offset-1">
      <div class="campaign-info">
        <h3 class="text-success">
          <?php echo $campaign->name;?>
        </h3>
        <p>
          <small>
            <?php echo $campaign->description;?>
          </small>
        </p>
      </div>
    </div>
    <div class="col-sm-6 padding-top-7">
      <div id="campaign-timer" class="campaign-timer"></div>
    </div>
  </div>

  <script type="text/javascript">
    var campaign_id = <?php echo $campaign->id;?>;
    $(function() {
      $('#campaign-timer').countdown(new Date('<?php echo $campaign->till_ts . ' GMT' . GMT_OFFSET;?>'), function(event) {
        $(this).text(
          event.strftime('%D days %H:%M:%S')
        );
      }).on('finish.countdown', function(e) {
        campaign_id = 0;
        $(this).html('<h3 class="text-info">This campaign is over now</h3>');
      });
    });
    
  </script>
<?php endif;?>