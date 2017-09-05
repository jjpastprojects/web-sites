<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PopUp Domination</title>
<link rel="stylesheet" type="text/css" href="./css/analytics.css" />
<script type="text/javascript" src="../javascript/jquery-1.7.min.js"></script>
<script type="text/javascript" src="../javascript/master.js"></script>
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
                      	<?php 
                      	if(!empty($camps[0])):
                      	 	foreach ($camps as $c):?>
                      	 	<div class="camprow">
								<div class="tmppreview">
									<div class="preview_crop">
										<div class="spacing">
											<div class="slider"><h2><?php echo $temppreview; ?></h2></div>
											<img src="<?php echo $previewurl[$c['id']]; ?>" height="<?php echo $height[$c['id']]; ?>" width="<?php echo $width[$c['id']]; ?>" />
										</div>
									</div>
								</div>
								<div class="namedesc">
									<a href="<?php echo 'index.php?section=analytics&action=view&id='.$id[$c['id']]; ?>"><?php echo $c['campaign'] ?></a><br/>
									<p class="description"><?php echo $c['desc']; ?></p>
								</div>
								<div class="current_analytics">
									<?php
									//echo $c['campaign'];
									//print_r($anay[$c['campaign']]);
									/*if(!isset($anay[$c['campaign']]) || empty($anay[$c['campaign']])){
										echo 't';
									}*/
									
		            				$stats = $anay[$c['campaign']];
		            				$arr = 20;
		            				$div = 100/5;
		            				$percent = array();
		            				if($stats['conversions'] != 0 && $stats['views'] != 0){
		            					$percent = round((intval($stats['conversions']) / intval($stats['views'])) * 100).'%';
		            				}else{
		            					$percent = '0%';
		            				}
		            				?>
		            				<span class="percent_converse"><?php echo $percent;?><br/><span class="smaller">Conversion rate Today</span></span>
		            				
								</div>
								<div class="actions">
							       	<?php
		        					$prevdata = unserialize($stats['previousdata']);
		        					if(!empty($prevdata)){
		            					$keys = array_keys($prevdata);
		            					$num = count($prevdata)-1;
		            					$premonth = $prevdata[$keys[$num]];
		            					echo $prevpercent =  round((intval($premonth['conversions']) / intval($premonth['views'])) * 100).'%';
		            					if(($percent - $prevpercent) > 0){
		            						echo '&uarr;';
		            					}else{
		            						echo '&darr;';
		            					}
		        					}else{
		        						echo 'No Previous Data';
		        					}
		        					?>
								</div>
								<div class="clear"></div>
							</div>
						<?php endforeach; ?>
						<?php else: ?>
							<h3>There is no Analytics Data to show just now.</h3>
						<?php endif; ?>
	                		
                          </div>
                       </div>
                     </div>
                   </div>
                   <div class="clear"></div>
          
      
  <div class="clearfix"></div>
                     <div id="popup_domination_form_submit">				
                    <div id="popup_domination_current_version">
          					 <p>You are currently running <strong>version <?php echo $this->version ?></strong></p>
          				  </div>
          				</div>
 	</div>

        </div>
    </div>
         <script type="text/javascript">
     	var popup_domination_url = '<?php echo $this->plugin_url ?>';
     </script>
</body>
</html>