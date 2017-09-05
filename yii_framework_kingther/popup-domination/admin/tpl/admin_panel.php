<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PopUp Domination</title>
<link rel="stylesheet" type="text/css" href="./css/campaigns.css" />
<script type="text/javascript" src="../javascript/jquery-1.7.min.js"></script>
<script type="text/javascript" src="../javascript/ajaxupload.js"></script>
<script type="text/javascript" src="../javascript/admin_lightbox.js"></script>
</head>
<body>
<?php if($this->saved): ?>
	<div id="message" class="updated"><p>Your Settings have been <strong>Saved</strong></p></div>
	<?php $this->saved = false; ?>
<?php endif; ?>
<?php if (!empty($campaignid)): ?>
<div class="use-this-code">
	<div class="use-this-content">
		<span>To display the lightbox, please insert this code between the &lt;head&gt; &lt;/head&gt; of your pages.</span><br/><br/>
		<code>&lt;script type=&quot;text/javascript&quot; src=&quot;<?php echo $this->plugin_url ?>js.php?popup=<?php echo $campaignid; ?>&quot;&gt;&lt;/script&gt;</code>
	</div>
</div>
<?php endif; ?>


	<div class="wrap with-sidebar" id="popup_domination">
			<div class="popup_domination_top_left">
				<img class="logo" src="<?php echo $this->plugin_url?>admin/css/img/popup-domination3-logo.png" alt="Popup Domination 3.0" title="Popup Domination 3.0" width="200" height="62" />
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
						<img class="waiting" style="display:none;" src="images/wpspin_light.gif" alt="" />
					</div>
				</div>
				<p>Campaign Editor</p>
				<div class="clear"></div>
				</div>
			<form action="index.php?section=campaigns&action=save<?php if(isset($this->campid) && !empty($this->campid)){echo '&id='.$this->campid; }else{echo '';}; ?>" method="post" id="popup_domination_form">
			<div style="display:none" id="popup_domination_hdn_div"><?php echo $fields?></div>
			<div class="clear"></div>
			<div id="popup_domination_container" class="has-left-sidebar">
			<div style="display:none" id="popup_domination_hdn_div2"></div>
			<div id="popup_domination_tabs" class="campaign-details">
				<div class="campaign-name-box">
					<label for="campname">Popup Name: </label>
					<input id="campname" name="campname" type="text" value="<?php if(isset($campname)){ echo $campname;}else{ echo 'Campaign Name...';} ?>" />
					<a href="#" class="checkname">Check Name</a>
					<div class="clear"></div>
					<p class="microcopy">e.g. Service Page Popup &#35;1</p>
					<img class="waiting" src="<?php echo $this->plugin_url; ?>/admin/css/loading.gif" alt="loading" width="15" height="15" />
					<div class="clear"></div>
				</div>
				<div class="campaign-description">
					<label for="campdesc">Popup Description: </label>
					<input name="campaigndesc" type="text" value="<?php if(isset($campdesc)){ echo $campdesc;}else{ echo 'Campaign Description...';} ?>" />
					<p class="microcopy">e.g. Testing incentive A to see how it converts.</p>
				</div>
				<div class="clear"></div>
			</div>
			<div id="popup_domination_tabs" class="tab-menu">
				<a class="icon home" href="<?php echo $this->plugin_url.'admin/'; ?>">Back to Campaign Managment</a>
				<a class="icon feel selected" href="#look_and_feel">Look &amp; feel</a>
				<a class="icon fields" href="#template_fields">Content</a>
				<a class="icon list" href="#list_items">Bullet List</a>
				<a class="icon schedule" href="#schedule">Display Settings</a>
				<a class="icon prev" href="#preview">Launch Preview</a>
			</div>
			<div class="notices" style="display:none;">
				<p class="message"></p>
			</div>
			<div class="flotation-device">
						<div class="mainbox" id="popup_domination_tab_look_and_feel">
						<div class="popdom_contentbox the_help_box">
								<h3 class="help">Help</h3>
								<div class="popdom_contentbox_inside">
								<?php $url =  $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; $tmpurl = explode('index.php?section=', $url);  $furl = $tmpurl[0].'uploader';?>
									<p>To upload your other themes, please go to the <a href="<?php echo 'http://'.$furl; ?>">Theme Uploader</a>.
									<p>If this is the first time you have installed PopUp Domination 3.0, you will need to download the Themes archive
and then upload them. Unfortunately due to the size of the Themes, we now have to separate them from the main plugin.
Don't worry though, there are no further charges, and nothing technical is involved.</p>
<p>See a <a href="http://popdom.assistly.com/customer/portal/articles/252964-theme-upload">help video</a> on how to do this step by step.</p>
								</div>
							</div>
							<br/>
							<div class="inside twodivs">
								<div class="popdom-inner-sidebar">
									<div class="postbox">
										<h3 class="hndle"><span>Choose a template style & colour</span></h3>
										<div class="sidebar-inside">
											<p class="popup_template">
												<select id="popup_domination_template" name="popup_domination[template]"><?php echo $opts?></select>
                                    		</p>
                                    		<p class="popup_color" <?php echo ((!empty($opts2))?'':' style="display:none"') ?>>
			                                	<select id="popup_domination_color_selected" name="popup_domination[color]"><?php print_r($opts2) ?></select>
			                                	<input type="hidden" class="selectedcolor" value="<?php echo $opts2; ?>" />
			                                </p>
											<div class="clear"></div>
                                		</div>
                                	</div>
	                            </div>
	                            <div id="normal-sortables">
									<div id="popup_domination_preview">
										 <?php 
											$style = '';
											if($cur_preview!=''){
												$style .= 'background-image:url(\''.$this->theme_url.$cur_preview.'\')';
												if(count($cur_size) == 2)
													$style .= ';width:'.$cur_size[0].'px;height:'.$cur_size[1].'px';
												$style = ' style="'.$style.'"';
											}
										?>
										<div class="preview" <?php echo $style ?>></div>
									</div>
								</div>
								<div class="clear"></div>
	                        	<div class="postbox" <?php echo ((!empty($cur_theme['button_colors']))?'':' style="display:none"')?> id="popup_domination_colors_container">
	                            	<h3 class="hndle"><span>Choose a button Color</span></h3>
	                                <div class="sidebar-inside">
	                                     	<?php
		                                        $btns = '';
		                                        if(isset($valbuttonc) && !empty($valbuttonc)){$button_color = $valbuttonc;}else{$button_color='blue';}
		                                        if(isset($cur_theme['button_colors'])){
		                                            foreach($cur_theme['button_colors'] as $c){
		                                                $btns .= '<option value="'.$c['color_id'].'"'.(($c['color_id']==$button_color)?' selected="selected"':'').'>'.$c['name'].'</option>';
		                                            }
		                                        }
		                                    ?>
                                			<p>
		                                        <select id="popup_domination_btn_color" name="popup_domination[button_color]"><?php echo $btns ?></select>
		                                        <input type="hidden" id="popup_domination_btn_color_selected" value="<?php echo $valbuttonc; ?>" />
		                                    </p>
									</div>
								</div>
							</div>
						<div class="clear"></div>
					</div>
					<div class="mainbox" id="popup_domination_tab_template_fields">
						<div class="inside twomaindivs">
							<div class="popdom_contentbox the_help_box">
								<h3 class="help">Help</h3>
								<div class="popdom_contentbox_inside">
									<p><u>When using the Premium Video Theme:</u></p>
									<p><strong>Video URL :</strong> Only use a url to a .FLV video file.</p>
								</div>
								<div class="clear"></div>
							</div>
							<div class="popdom_contentbox the_content_box">
								<div class="popdom_contentbox_inside">
									<div class="elements template_fields">
										<?php echo $field_str ?>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="mainbox" id="popup_domination_tab_list_items">
						<div class="inside twomaindivs" id="popup_domination_listitems">
							<div class="popdom_contentbox the_help_box">
								<h3 class="help">Help</h3>
								<div class="popdom_contentbox_inside">
									<p>Use the bullets to the left to create a list of points which make your point, argument or product more convincing.</p>
									<p>We have outlined the recommended amount of bullet points per template. Any bullets over this amount, will not be shown on the template.</p>
									<p>Example:</p>
									<img src="<?php echo $this->plugin_url;?>admin/css/images/bullets.png" height="193" width="383" alt="" />
									<p>Make sure to head over to you support area if you have any problems</p>
									<p><a href="https://popdom.assistly.com/">Click Here to get there</a></p>
									<p>You can also contact us directly there too.</p>
								</div>
								<div class="clear"></div>
							</div>
							<div class="popdom_contentbox the_content_box">
								<h3>What are your key points?</h3>
								<div class="popdom_contentbox_inside">
									<p id="list_allowed_size" class="msg">
										<strong>This theme has a limit of <span><?php echo $cur_theme['list_count'] ?></span> check boxes.</strong>
										<br />
										Why is there a limit? We want to help you get the best out of your lightbox. Imposing a limit means that the design will remain beautiful and result in high conversions.
									</p>
									<ul class="list_items">
										<?php echo $listitems?>
									</ul>
									<a href="#addnew" class="grey-btn addnew"><span>Add Another</span></a>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="mainbox" id="popup_domination_tab_schedule">
						<div class="popdom_contentbox the_help_box">
							<h3 class="help">Help</h3>
							<div class="popdom_contentbox_inside">
								<p><strong>Reset Your Cookies to test the popup on your live website again.</strong></p>
								<p><a href="#clear" class="button cookieclear">Clear my cookie</a> <img class="waiting" style="display:none;" src="<?php echo $this->plugin_url; ?>admin/css/img/ajax-loader.gif" alt="" /></p>
								<p><strong>On Website Load:</strong> The popup will appear as soon as the webpage has been fully loaded by the user's browser.</p>
								<p><strong>When mouse leaves the browser viewport:</strong> The popup will appear when the user's mouse enters the address back area. This option in great for when you want the popup to appear when the user tried to leave your website, but won't appear when they click on links on your website.</p>
								<p style="margin-right:15px;"><strong>When the user tries to leave the page:</strong> The popup will appear when ever the user clicks on a link or attempts to leave the page. If you have many links to different parts of your site, we don't recommend this setting.
								This setting also makes an alert box appear before the popup appears. The user will have to click the "Stay On Page" option in the alert box <strong>before</strong> the popup will appear.
								</p>
								<p><strong>Example:</strong></p>
								<img src="<?php echo $this->plugin_url;?>admin/css/images/alert.png" height="178" width="582" alt="" />
								<p>If you are experiencing problems with your popup, please have a look at our help articles at:</p>
								<p><a href="https://popdom.assistly.com/">our Assistly Help Area.</a></p>
							</div>
						</div>
						<div class="inside twomaindivs">
							<div class="the_content_box">
							<div class="popdom_contentbox" style="margin-left:0px;">
							<div class="popdom_contentbox_inside schedule_tab">
							<h3>When the close button is clicked, how long should it be before the lightbox is shown again?</h3>
							<span class="example">Please specify in days - e.g. 7. The Minimal is 1, entering 0 will result in the popup not appearing.</span>
							<input type="text" name="popup_domination[cookie_time]" value="<?php if(isset($campaign['schedule']['cookie_time'])){echo intval($campaign['schedule']['cookie_time']);}else{echo '7';} ?>" /> 
							<h3>How many times must site page(s) be visited before the popup appears?</h3>
							<span class="example">Note: 1 and 0 will both make the PopUp appear on the first visit.</span>
							<input type="text" name="popup_domination[impression_count]" value="<?php if(isset($campaign['schedule']['impression_count'])){echo $campaign['schedule']['impression_count'];}else{ echo '0';}?>" />
							<ul >
							<li class="show_opts opt_open">
							<h3>What should trigger the popup to display?</h3>
							<p><input type="radio" name="popup_domination[show_opt]" value="open" id="show_opt_open" <?php echo $show_opt == 'open' ? ' checked="checked"':'';?> /> <label for="show_opt_open">On Website page load</label></p>
							<p style="margin-left:25px;  <?php echo $show_opt == 'open' ? '':' display:none';?> " class="show_opt_open toggle">
								How Long should the delay be before the popup appears? This should be in seconds.
								<input type="text" class="open_delay" name="popup_domination[delay]" value="<?php echo floatval($campaign['schedule']['delay']) ?>" />
							</p>
							</li>
							<li class="show_opts opt_mouselave">
							<p><input type="radio" name="popup_domination[show_opt]" value="mouseleave" id="show_opt_mouseleave" <?php echo $show_opt == 'mouseleave' ? ' checked="checked"':'';?> /> <label for="show_opt_mouseleave">When mouse leaves the browser viewport. (up towards the address bar)</label></p>
							</li>
							<li class="show_opts opt_unload">
							<p><input type="radio" name="popup_domination[show_opt]" value="unload" id="show_opt_unload"<?php echo $show_opt == 'unload' ? ' checked="checked"':'';?> /> <label for="show_opt_unload">When the user tries to leave the page (This option requires a javascript alert box).</label></p>
							<p style="margin-left:25px; <?php echo $show_opt == 'unload' ? '':'display:none';?>" class="show_opt_unload toggle">Javascript alert box text <input type="text" name="popup_domination[unload_msg]" id="popup_domination_unload_msg" value="<?php echo $this->input_val($this->option('unload_msg')) ?>"<?php echo $show_opt == 'unload' ? '' : ' disabled="disabled"';?> /></p>
							</li>
							</ul>
							</div>
							</div>
							<div class="popdom_contentbox" style="margin-top:20px; margin-left:0px;">
							<div class="clear"></div>
							</div>
							
						<div class="clear"></div>
						</div>
					</div>
				</div>
				</div>
<div class="clear"></div>
					<div id="popup_domination_form_submit">
						<div class="submit">
							<input type="text" class="extra_fields" name="extra_fields" value="0" style="display:none" />
							<input type="text" name="campaignid" value="<?php echo $campaignid; ?>" style="display:none" />
							<?php if(isset($camp_id)){ $disabled = ''; }else{ $disabled = 'disabled="disabled" ';} ?>
							<span style="position: relative; height:55px;">
								<input class="savecamp save-btn" type="submit" name="update" <?php echo $disabled; ?> value="Save Changes" />
								<?php if(!isset($camp_id)){?>
								<div class="removeme" style="position: absolute; top:-12px;left:0px;bottom:0px;right:0px;height:37px;background-color:transparent;"></div>
								<?php } ?>
							</span>											
						</div>						
						<p><strong>Remember:</strong> You must check your Campaign Name before you can create a new campaign.</p>
						
						<div id="popup_domination_current_version">
							<p>You are currently running <strong>version <?php echo $this->version?></strong></p>
						</div>
					</div>
					<div class="clear"></div>
			</form>
</div>
    <script type="text/javascript">
		var popup_domination_tpl_info = <?php echo $js?>, popup_domination_theme_url = '<?php echo $this->theme_url ?>';
	<?php if (!empty($campaignid)): ?>
		var popup_domination_campaign_id = <?php echo $campaignid; ?>;
	<?php else: ?>
		var popup_domination_campaign_id = 0;
	<?php endif; ?>
     	var popup_domination_url = '<?php echo $this->plugin_url ?>';
	</script>
</body>
</html>