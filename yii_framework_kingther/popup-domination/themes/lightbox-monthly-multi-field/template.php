<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id ?>"<?php echo $delay_hide ?>>
    <div class="lightbox-overlay"></div>
    <div class="lightbox-main lightbox-color-<?php echo $color ?>">
        <a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id ?>"><span>Close</span></a>
        <div class="popup-dom-border">
            <div class="lightbox-top">
                <div class="fade"></div>
                <div class="left">
                    <div class="heading"><p><?php echo $fields['title'] ?></p></div>
                    <p class="small_para"><?php echo nl2br($fields['short_paragraph']) ?></p>
                    <ul class="bullet-list"><?php
                        $count = 1;
                        if(isset($list_items) && count($list_items) > 0):
                            foreach($list_items as $l):
                                if($count > 5)
                                    break;
                                ?>
                                <li><?php echo $l ?></li><?php
                                $count++;
                            endforeach;
                        endif;
                        ?>
                    </ul>
                    <p class="secure"><?php echo $fields['footer_note'] ?></p>
                </div>
                <div class="right lightbox-signup-panel">
                    <div class="image_right">
                        <?php
                        if(isset($fields['right_image']) && !empty($fields['right_image'])) {
                            echo '<img src="' . $fields['right_image'] . '" alt="" />';
                        }
                        ?>
                    </div>
<?php if($provider != 'form' && $provider != 'nm'): ?>
                        <div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url . 'css/images/wait.gif'; ?>" /></div>
                        <div class="form">
                            <div>
                                <form id="removeme">
    <?php echo $inputs['hidden'] . $fstr ?>
                                    <input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url ?>images/trans.png" class="<?php echo $button_color ?>-button" />
                                </form>
                            </div>
                        </div>
                            <?php else: ?>
                        <form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
                            <div>
    <?php echo $inputs['hidden'] . $fstr ?>
                                <input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url ?>images/trans.png" class="<?php echo $button_color ?>-button" />
                            </div>
                        </form>
<?php endif; ?>
                </div>
                <div class="clear"></div>
            </div>	
        </div>
        <?php if(isset($tclub)) { echo $promote_link; } else { echo $promote_link_f; } ?>
    </div>
</div>