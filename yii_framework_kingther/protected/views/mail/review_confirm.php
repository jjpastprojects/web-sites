<table cellspacing="0" cellpadding="10" style="color:#666;font:13px Arial;line-height:1.4em;width:100%;">
    <tbody>
        <tr>
            <td style="color:#4D90FE;font-size:22px;border-bottom: 2px solid #4D90FE;">
                <?php echo $title; ?>
            </td>
        </tr>                
        <tr>
            <td>
                <p>Hi, <?php echo $name; ?>!</p>
                <p>Thanks for your review of <?php echo $product; ?> on <a href="www.chiromonkey.com">www.chiromonkey.com</a>.</p>
                <p>Please click <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/chiropractic_software/confirm_a_review/<?php echo $url_name; ?>.html?email=<?php echo $email; ?>&confirmation_key=<?php echo $confirmation_key; ?>">here</a> to confirm your review.</p>
            </td>
        </tr>
    </tbody>
</table>
