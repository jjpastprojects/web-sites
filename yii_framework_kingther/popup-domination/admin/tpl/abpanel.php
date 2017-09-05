<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PopUp Domination</title>
<link rel="stylesheet" type="text/css" href="./css/ab.css" />
<script type="text/javascript" src="../javascript/jquery-1.7.min.js"></script>
<script type="text/javascript" src="../javascript/abtesting.js"></script>
<script type="text/javascript" src="../javascript/master.js"></script>
<script type="text/javascript" src="../javascript/graphs.jquery.1.0.js"></script>
<link rel="stylesheet" type="text/css" href="./graph.css" />
</head>
<body>
<?php if($this->saved): ?>
	<div id="message" class="updated"><p>Your Settings have been <strong>Saved</strong></p></div>
	<?php $this->saved = false; ?>
<?php endif; ?>
<div class="use-this-code">
	<div class="use-this-content">
		<span>To display the A/B Split, please insert this code between the &lt;head&gt; &lt;/head&gt; of your pages.</span><br/><br/>
		<script src="" type="text/javascript"></script>
		<code>&lt;script type=&quot;text/javascript&quot; src=&quot;//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js&quot;&gt;&lt;/script&gt;</code><br />
		<code>&lt;script type=&quot;text/javascript&quot; src=&quot;<?php echo $this->plugin_url ?>js.php?popup=<?php echo $id; ?>&type=ab&quot;&gt;&lt;/script&gt;</code>
	</div>
</div>
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
				<p><a href="<?php echo $this->plugin_url.'admin/index.php?section=absplit'; ?>">&lt; Back to A/B Campaign Management</a></p>
				<div class="clear"></div>
				</div>
			<?php $id = $_GET['id']; ?>
			<form action="<?php echo $this->plugin_url.'admin/index.php?section=absplit&action=save&id='.$id;?>" method="post" id="popup_domination_form">
			<div style="display:none" id="popup_domination_hdn_div"><?php echo $fields?></div>
			<div class="clear"></div>
			<div id="popup_domination_container" class="has-left-sidebar">
			<div style="display:none" id="popup_domination_hdn_div2"></div>
			<div id="popup_domination_tabs" class="campaign-details">
				<div class="campaign-name-box">
					<label for="campname">Popup Name: </label>
					<input id="campname" name="campname" type="text" value="<?php if(isset($abname)){ echo $abname;}else{ echo 'Campaign Name...';} ?>" />
					<a href="#" class="checkname">Check Name</a>
					<div class="clear"></div>
					<p class="microcopy">e.g. Service Page Popup &#35;1</p>
					<img class="waiting" src="<?php echo $this->plugin_url; ?>/css/loading.gif" alt="loading" width="15" height="15" />
					<div class="clear"></div>
				</div>
				<div class="campaign-description">
					<label for="campdesc">Popup Description: </label>
					<input name="campaigndesc" type="text" value="<?php if(isset($abdesc)){ echo $abdesc;}else{ echo 'Campaign Description...';} ?>" />
					<p class="microcopy">e.g. Testing incentive A to see how it converts.</p>
				</div>
				<div class="clear"></div>
			</div>
			<div id="popup_domination_tabs" class="tab-menu">
				<a class="icon feel selected" href="#look_and_feel">Select Campaigns</a>
				<a class="icon fields" href="#ab_setup">A/B Split Setup</a>
				<a class="icon list" href="#results">Results</a>
			</div>
			<div class="notices" style="display:none;">
				<p class="message"></p>
			</div>
			<div class="flotation-device">
						<div class="mainbox" id="popup_domination_tab_look_and_feel">
							<div class="inside twodivs">
                            	<h3>Select Campaigns</h3>
                            	<span class="example">Please Select the Campaigns you want in this test</span>
                             <table>
								<?php foreach ($campaigns as $campaignnum => $info): ?>
                                <tr>
                                    <?php
                                        if($ab_campaigns){
                                            foreach ($ab_campaigns as $ab_campaignnum){
                                                if($ab_campaigns[$campaignnum] == $info['campaign']){
                                                    $tick[$info['campaign']] = 'checked = "yes"';	 
                                                }else{
                                                    $tick[$info['campaign']] = '';
                                                }
                                            }
                                            if (array_key_exists($info['campaign'], $tick)) {
                                                echo '';
                                            }else{
                                                $tick[$info['campaign']] = '';
                                            }
                                        }
                                    ?>
                                    <td><input <?php if(isset($tick)){ echo $tick[$info['campaign']];} ?> type="checkbox" name="campaign[]" value="<?php echo $info['campaign']; ?>" /><?php echo $info['campaign']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                          </div>
                          <div class="clear"></div>
                      </div>
                      <div class="mainbox" id="popup_domination_tab_ab_setup">
							<div class="inside twodivs">                            
                            <h3>Percentage Split:</h3>
                            <span class="example">For example, if you type 70, popup A will show 70% of the time and popup B, 30%.</span>
                    		<input type="text" value="<?php if(isset($absettings['visitsplit'])){echo $absettings['visitsplit'];}else{ echo '';} ?>" name="numbervisitsplit" class="visitsplit" />
                    		<h3>Conversion Page:</h3>
                    		<span class="example">As an A/B test overwrites your PopUp settings, please choose from below the page someone will reach after opting in.</span>
                    		<input type="text" value="<?php if(isset($absettings['page'])){echo $absettings['page'];}else{ echo '';} ?>" name="conversionpage" class="conversionpage" />
                          </div>
                          <div class="clear"></div>
                      </div>
                      
                      
                      <div class="mainbox" id="popup_domination_tab_results">
                        <?php if(!empty($abstats)): ?>						
		                <div class="holdall">
							<div id="graph-wrapper">
								<div class="line-chart chart-one">
									<h2>Analytic Data for Split Campaign : <?php echo $abname; ?> (Conversions)</h2>
									<br/>
									<table id="data-table-two" style="display:none;" border="1" cellpadding="10" cellspacing="0" summary="Analytic Data for Split Campaign : ">
										<thead>
											<tr>
												<th></th>
											<?php $c = 0;
												 foreach($abstats as $campaignid => $campaign_stats):
												 	if(count($campaign_stats) > $c){
														$max = $campaignid;
														$c = count($campaign_stats);
													} 
												 endforeach;
												 foreach($abstats[$max] as $campaign_stats => $camp_stat_options): ?>
													<th scope="col"><?php echo $campaign_stats; ?></th>
										   <?php endforeach; ?>
											</tr>
										</thead>
										<tbody>
											<?php $i= 0; foreach($abstats as $campaignid): ?>
												<tr>
													<th scope="row"><?php echo $campaigns[$i]['campaign']; ?></th>
													<?php foreach($campaignid as $month => $values): ?>
														<td><?php echo intval($values['optin']); ?></td>
													<?php endforeach; ?>
												</tr>
											<?php $i++; endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<?php else: ?>
							<h2>There is No Analytic Data Yet.</h2>
						<?php endif; ?>
					</div>
				</div>
				<div class="clear"></div>
					<div id="popup_domination_form_submit">
						<div class="submit">
							<?php echo $this->token_field(); ?>
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
							<p>You are currently running <strong>version 3.4.6</strong></p>
						</div>
					</div>
					<div class="clear"></div>
        </div>
    </div>
    <script type="text/javascript">
    <?php if (!empty($campaignid)): ?>
		var popup_domination_campaign_id =<?php echo $id; ?>;
	<?php else: ?>
		var popup_domination_campaign_id = 0;
	<? endif; ?>
    	var popup_domination_url = '<?php echo $this->plugin_url ?>';
	</script>
</body>
</html>