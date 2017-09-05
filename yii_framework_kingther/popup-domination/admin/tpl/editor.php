
<div class="wrap">
	<div><strong>Please save settings on the other tabs before using the editor.</strong></div>
	<div class="fileedit-sub">
    	<div class="alignleft">
        	<big><?php echo $file ?></big>
        </div>
        <div class="alignright">
        	<form method="post" action="<?php echo $this->opts_url ?>#advanced_view">
            	<strong><label for="theme">Select theme to edit: </label></strong>
                <select id="theme" name="theme"><?php echo $themestr ?></select>
                <input type="submit" class="button" value="Select" name="Submit" />
            </form>
        </div>
        <br class="clear" />
    </div>
    <form method="post" action="index.php#advanced_view" id="template">
        <div>
        	<textarea id="newcontent" name="newcontent" rows="25" cols="70"><?php echo $this->input_val($file_content) ?></textarea>
             <input type="hidden" value="theme-editor" name="action" />
			 <input type="hidden" value="<?php echo $file ?>" name="file" />
			 <input type="hidden" value="<?php echo $cur_theme ?>" name="theme" />
		 </div>
         <div>
         	<p class="submit">
            	<input type="submit" value="Update File" class="button-primary" name="submit" />
            </p>
        </div>
    </form>
	<div id="templateside">
    	<h3>Theme Files</h3>
        <?php if(isset($cur_theme)):
		$arr = array('Config'=>array('.txt'),
					 'Templates'=>array('.html','.htm','.php'),
					 'Styles'=>array('.css'));
		foreach($arr as $a => $b): 
			$files = $this->get_file_list($this->theme_path.$cur_theme.'/',false,$b,$this->natypes);?>
        <h4><?php echo $a ?></h4>
        <ul>
        <?php foreach($files as $f): ?>
        	<li><a href="index.php?theme=<?php echo $cur_theme ?>&amp;file=<?php echo $f ?>#advanced_view"><?php echo $f ?></a><?php
            	if($orig = $this->get_original_file($cur_theme,$f)): ?><br />
                	<small>(<a href="index.php?theme=<?php echo $cur_theme ?>&amp;file=<?php echo $f ?>&amp;action=restore#advanced_view">Restore original</a>)</small><?php endif ?></li>
        <?php endforeach; ?>
        </ul>
		<?php endforeach; ?>
        <?php endif; ?>
    </div>
    <br class="clear" />
</div>