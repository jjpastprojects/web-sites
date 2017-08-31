<?php

function invitation_email($data)
{
	$ci = &get_instance();

	return $ci->send_email_template($data['email'], 'Lastnamecompany Welcome Email', 'new_user', $data);
}