<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PopUp Domination</title>
<link rel="stylesheet" type="text/css" href="./css/analytics.css" />
<link rel="stylesheet" type="text/css" href="./graph.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../javascript/master.js"></script>
<script type="text/javascript" src="../javascript/graphs.jquery.1.0.js"></script>
<script>
	$(document).ready(function() {  
	 	$('.chart').graphs( {
	 		data: '#data-table',
	 		container: '.chart'
	 	})
	 	$('.charttwo').graphs( {
	 		data: '#data-table-two',
	 		container: '.charttwo'
	 	})
	 	//createGraph('#data-table-two', '.charttwo');
	 });
</script>
</head>

<body>
<div class="wrap with-sidebar" id="popup_domination">
      <div class="popup_domination_top_left">
          <img class="logo" src="<?php echo $this->plugin_url?>admin/css/img/popup-domination3-logo.png" alt="Popup Domination 3.0" title="Popup Domination 3.0" width="200" height="62" /><div>
      <div id="popup_domination_active">
              <span class="wording">
                          <?php
                              $text = '<img src="'.$this->plugin_url.'admin/css/images/off.png" alt="off" width="6" height="6" />'; $class = 'inactive'; $text2 = '<img src="'.$this->plugin_url.'admin/css/images/on.png" alt="on" width="6" height="6" />'; $class2 = 'turn-on';$text3 = 'Inactive';$text4 = 'Active';$text5 = 'TURN ON';$text6 = 'TURN OFF';
                              if($this->is_enabled()){
                                  $text = '<img src="'.$this->plugin_url.'admin/css/images/on.png" alt="on" width="6" height="6" />';
                                  $text2 = '<img src="'.$this->plugin_url.'admin/css/images/off.png" alt="off" width="6" height="6" />';
                                  $text3 = 'Active';
                                  $text4 = 'Inactive';
                                  $text5 = 'TURN OFF';
                                  $text6 = 'TURN ON';
                                  $class = 'active';
                                  $class2 = 'turn-off';
                              }
                          ?>
                          <span class="<?php echo $class ?>">
                      <?php echo $text; ?> PopUp Domination is</span>  <?php echo $text3 ?></span>
                  </span>
              </span>
              <div class="popup_domination_activate_button">
                  <div class="border">
                      <?php echo $text2 ?>
                      <a href="#activation" class="<?php echo $class2 ?>"><?php echo $text5; ?></a>
                  </div> 
                  <img class="waiting" style="display:none;" src="<?php echo $this->plugin_url ?>images/wpspin_light.gif" alt="" />
              </div>
          </div>
          <p>Analytics</p>
          <div class="clear"></div>
      </div>
      </div>
      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="popup_domination_form">
      <div style="display:none" id="popup_domination_hdn_div"><?php echo $fields?></div>
      
      <div class="clear"></div>
      
      <div id="popup_domination_container" class="has-left-sidebar">
      		<div class="tab-menu" id="popup_domination_tabs">
                <a class="icon" href="<?php echo $this->plugin_url.'admin/'; ?>">Campaigns</a></li>
                <a class="icon" href="<?php echo $this->plugin_url.'admin/index.php?section=analytics'; ?>">Analytics</a>
                <a class="icon" href="<?php echo $this->plugin_url.'admin/index.php?section=absplit'; ?>">A/B Campaigns</a>
                <a class="icon" href="<?php echo $this->plugin_url.'admin/index.php?section=mailinglist'; ?>">Mailing List Manager</a>
                <a class="icon" href="<?php echo $this->plugin_url.'admin/index.php?section=promote'; ?>">Promote</a>
                <a class="icon" href="<?php echo $this->plugin_url.'admin/index.php?section=uploader'; ?>">Theme Uploader</a>
			</div>
      <div style="display:none" id="popup_domination_hdn_div2"></div>
      <div class="mainbox" id="popup_domination_campaign_list">
          <div class="flotation-device">
          
                  <div class="mainbox" id="popup_domination_tab_look_and_feel">
                  
                      <div class="inside twodivs">
                      	<?php foreach($data as $d): ?>
							<?php $campname =  $data[0]['campname']; ?>
							<?php $views =  $data[0]['views']; ?>
							<?php $conversions = $data[0]['conversions']; ?>
							<?php $prevdata = $data[0]['previousdata']; ?>
						<?php endforeach; ?>
		 				<div id="graph-wrapper">
						<div class="chart" style="margin-bottom:30px;">
						<br/><br/>
							<h2>Current Month's Analytic Data for Campaign : <?php echo $campname; ?></h2>
							<br/>
							<table style="display:none" id="data-table" border="1" cellpadding="10" cellspacing="0" summary="Current Month's Analytic Data for Campaign :">
								<tbody>
									<tr>
										<th scope="row">Views</th>
										<td><?php echo intval($views); ?></td>
									</tr>
									<tr>
										<th scope="row">Conversions</th>
										<td><?php echo intval($conversions); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<?php if(!empty($prevdata)): ?>
						<?php $monthsviews = 0; $monthsconv = 0 ?>
						<div class="charttwo">
						<br/><br/>
							<h2>Last 5 Month's Analytic Data for Campaign : <?php echo $campname; ?></h2>
							<br/>
							<table id="data-table-two" style="display:none;" border="1" cellpadding="10" cellspacing="0" summary="Current Month's Analytic Data for Campaign :">
								<thead>
									<tr>
										<th></th>
									<?php $prevdata = unserialize($prevdata); foreach($prevdata as $k => $p): ?>
										<th scope="col"><?php echo $k; ?></th>
									<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">Views</th>
										<?php foreach($prevdata as $p): ?>
											<td><?php echo intval($p['views']); ?></td>
										<?php endforeach; ?>
									</tr>
									<tr>
										<th scope="row">Conversions</th>
										<?php $avg = 0;  foreach($prevdata as $p): ?>
											<td><?php echo intval($p['conversions']); ?></td>
											
											<?php $monthsconv = $monthsconv + intval($p['conversions']);?>
											<?php $monthsviews = $monthsviews + intval($p['views']);?>
											<?php $lstavg = round((intval($monthsconv) / intval($monthsviews)) * 100); ?>
											<?php $avg = $avg + $lstavg;?>
											
										<?php endforeach; ?>
									</tr>
								</tbody>
							</table>
						</div>
						<?php endif; ?>
						<?php if(!isset($lstavg)){$lstavg = 0;} if(!isset($avg)){$avg = 0;} ?>
						<div class="averages">
							<div class="percent">
								<?php $math = round((intval($conversions) / intval($views)) * 100); ?>
								<h2>Conversion Percentage:</h2>
								<?php if($math <= 0){ ?>
									<h1 class="red"><?php echo $math.'%'; ?></h1>
								<?php }else{ ?>
									<h1 class="green"><?php echo $math.'%'; ?></h1>
								<?php } ?>
								
							</div>
							<div class="lst-average">
								<h2>Last Month's Conversion Percentage</h2>
								<center><h1><?php echo round($lstavg).'%';?></h1></center>
							</div>
							<div class="average-percent">
								<h2>Last 5 Months Average Conversion</h2>
								<center><h1><?php echo round($avg/5).'%';?></h1></center>
							</div>
						</div>

						
						<div class="clear"></div>
						
	                		
                          </div>
                       </div>
                     </div>
                   </div>
                   <div class="clear"></div>
          
      
  <div class="clearfix"></div>
 	</div>

        </div>
    </div>
        <script type="text/javascript">
		var analytics_name = '<?php echo $campname; ?>', analytics_views = '<?php echo intval($views); ?>', analytics_convers = '<?php echo intval($conversions); ?>', graph = "createGraph('#data-table', '.chart');createGraph('#data-table-two', '.charttwo')", popup_domination_theme_url = '<?php echo $this->theme_url ?>', popup_domination_url = '<?php echo $this->plugin_url ?>';
	 </script>
</body>
</html>
