<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id ?>"<?php echo $delay_hide ?>>
    <div class="lightbox-overlay"></div>
    <div class="lightbox-main lightbox-color-<?php echo $color ?>">
        <div class="popup-dom-border">
            <div class="lightbox-top">
                <div class="lightbox-top-content">
                    <div class="lightbox-heading"><p><?php echo $fields['title'] ?></p>
                    </div>
                    <div class="lightbox-subheading">
                        <p ><?php echo nl2br($fields['short_paragraph']) ?></p>
                    </div>
                </div>
            </div>


            <div class="lightbox-bottom">
                <div class="lightbox-left-content">
                    <div class="bullet-listx">
                        <ul class="bullet-list"><?php
                            $count = 1;
                            if(isset($list_items) && count($list_items) > 0):
                                foreach($list_items as $l):
                                    if($count > 4)
                                        break;
                                    ?>
                                    <li><?php echo $l ?></li><?php
                                    $count++;
                                endforeach;
                            endif;
                            ?>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="lightbox-right-content">
<?php if($provider != 'form' && $provider != 'nm'): ?>
                        <div class="lightbox-signup-panel">
                            <div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url . 'css/images/wait.gif'; ?>" /></div>
                            <div class="form">
                                <div>
                                    <form id="removeme">
    <?php echo $inputs['hidden'] . $fstr ?>
                                        <div>
                                            <input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url ?>images/trans.png" class="<?php echo $button_color ?>-button" />
                                        </div>
                                        <div class="secure-note">
                                            <span class="secure"><?php echo $fields['footer_note'] ?></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
<?php else: ?>
                        <div class="lightbox-signup-panel">
                            <form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
                                <div>
    <?php echo $inputs['hidden'] . $fstr ?>
                                    <div>
                                        <input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url ?>images/trans.png" class="<?php echo $button_color ?>-button" />
                                    </div>
                                    <div class="secure-note">
                                        <span class="secure"><?php echo $fields['footer_note'] ?></span>
                                    </div>
                                </div>
                            </form>
                        </div>
<?php endif; ?>
                </div>
            </div>
        </div>
<?php if(isset($tclub)) { echo $promote_link; } else { echo $promote_link_f; } ?>
    </div>
</div>