<?php

function shop_url($shop)
{
	$ci = &get_instance();

	if($shop->custom_domain)
	{
		return sprintf(
			'http://%s%s', $shop->domain, $ci->config->item('proto')
		);
	}
	else
	{
		return sprintf(
			'http://%s.%s%s', $shop->domain, $ci->config->item('domain'), $ci->config->item('proto')
		);
	}
}

function logo_url($default = '/img/logo1.png')
{
	$CI = & get_instance();
	
	if(!$CI->data['shop']->logo)
		return $default;

	return $CI->config->item('url_path', 'shop_logo') . IMG_THUMB_PREFIX . $CI->data['shop']->logo;
}

function unlink_shop_logo()
{
	$CI = & get_instance();
	
	if(!$CI->data['shop']->logo)
		return FALSE;

	safe_unlink($CI->config->item('path', 'shop_logo') . $CI->data['shop']->logo);
	safe_unlink($CI->config->item('path', 'shop_logo') .  IMG_THUMB_PREFIX . $CI->data['shop']->logo);

	return TRUE;
}

function is_main_shop($shop)
{
	$ci = &get_instance();
	return $shop->domain == $ci->config->item('domain');
}

function get_oauth_redirect_uri($shop)
{
	$ci = &get_instance();

	if(is_main_shop($shop) || !$shop->custom_domain)
	{
		$domain = $ci->config->item('domain');	
	}
	else
	{
		$domain = $shop->domain;
	}
	
	return 'http://' . $domain . $ci->config->item('proto') . '/';
}