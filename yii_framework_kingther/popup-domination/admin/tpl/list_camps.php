<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PopUp Domination</title>
<link rel="stylesheet" type="text/css" href="./css/campaigns.css" />
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
          <p>Campaign Management</p>

          <div class="clear"></div>
      </div>
      </div>
      <form action="index.php?section=campaigns&action=edit" method="post" id="popup_domination_form">
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
                <p><a href="<?php echo $this->plugin_url; ?>admin?action=logout">Log Out</a></p>

			</div>
      <div style="display:none" id="popup_domination_hdn_div2"></div>
      <div class="mainbox" id="popup_domination_campaign_list">
          <div class="flotation-device">
          
                  <div class="mainbox" id="popup_domination_tab_look_and_feel">
                  
                      <div class="inside twodivs">          
                          <div class="newcampaign">
                              <a class="green-btn" href="<?php echo 'index.php?section=campaigns&action=edit';?>"><span>Create New Popup</span></a>
                              <p class="campaign-notice">You have <?php echo $count; ?> Popups.</p>
                              <div class="clear"></div>
                          </div>
                          
                          <div class="clear"></div>
                          <?php if(!empty($camps[0])): ?>
                              <?php foreach ($camps as $c): ?>
                                  <div class="camprow" id="camprow_<?php echo $c['id']; ?>">
                                      <div class="tmppreview">
                                          <div class="preview_crop">
                                              <div class="spacing-img">
                                                  <div class="slider"><h2><?php echo $tempname[$c['id']]; ?></h2></div>
                                                  <img class="img" id="test" src="<?php echo $previewurl[$c['id']]; ?>" height="<?php echo $height[$c['id']]; ?>" width="<?php echo $width[$c['id']]; ?>" />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="namedesc">
                                     
                                          <a href="<?php echo 'index.php?section=campaigns&action=edit&id='.$c['id']; ?>"><?php echo $c['campaign']; ?></a><br/>
                                          <p class="description"><?php echo $c['desc']; ?></p>
                                      </div>
                                      <div class="actions">
                                          <ui>
                                         <a id="<?php echo $c['id']; ?>" title="<?php echo $c['campaign']; ?>" class="deletecamp thedeletebutton" href="#deletecamp">Delete</a>
                              
                                          </li>
                                          </ui>
                                      </div>
                                      <div class="clear"></div>
                                  </div>
                              <?php endforeach; ?>
                          <?php endif; ?>
                          </div>
                       </div>
                     </div>
                   </div>
                   <div class="clear"></div>
                   <div id="popup_domination_form_submit">				
                    <div id="popup_domination_current_version">
          					 <p>You are currently running <strong>version <?php echo $this->version ?></strong></p>
          				  </div>
          				</div>
		</div>
      
  <div class="clearfix"></div>
       	 </div>
      </div>
           <script type="text/javascript">
     	var popup_domination_url = '<?php echo $this->plugin_url ?>';
     </script>
</body>
</html>