<?php

function featured_img($img)
{
	if(!$img)
		return '';

	$ci = &get_instance();

	return $ci->config->item('url_path', 'featured_img') . $img;
}

function sndfeatured_img($img)
{
	if(!$img)
		return '';

	$ci = &get_instance();

	return $ci->config->item('url_path', 'sndfeatured_img') . $img;
}

function tpl_thumb($tpl, $size = 'lo-res', $storage = 'S3')
{
	$ci = &get_instance();
	
	if(!$tpl)
		return FALSE;
	
	$filename = ($size == 'lo-res' ? $tpl->low_res_b : $tpl->hi_res_b);
	
	$tpl->lo_res_dir = 'lo-res';
	$tpl->hi_res_dir = 'hi-res';

	$size_dir = $size == 'lo-res' ? $tpl->lo_res_dir : $tpl->hi_res_dir;

	if($storage == 'S3')
	{
		$path = 'http://';

		$path .= ($ci->config->item('s3_domain')?($ci->config->item('s3_domain') . '/'):'') . $ci->config->item('logo_bucket');

		$path .= '/' . $tpl->dir . '/' . $size_dir . '/' . $filename;
	}
	else if($storage == 'cloudfront')
	{
		$path = get_signed_cloudfront_url(
			'http://' . $ci->config->item('cloudfront_domain') . '/' . $tpl->dir . '/' . $size_dir . '/' . $filename
		);
	}
	else
	{
		return FALSE;
	}

	return $path;
}

function logo_proxy_url($template, $size)
{
	return site_url(sprintf('/logos/%s_%s.png', $template->id, $template->lastname_id)); 
}

function printful_image_url($item)
{
	return site_url(
		'catalog/printfull_image/' . $item->id . '.png'
	);
}

function custom_print_url($item)
{
	$ci = &get_instance();

	return $ci->config->item('url_path', 'print_preview') . $item->custom_print;
}

function print_url($item)
{
	return $item->custom_print ? custom_print_url($item) : tpl_thumb($item->template);
}

// function product_thumb($product, $location = FALSE)
// {
// 	$img_path = '/img/products/';
	
// 	if($location == 'listing' && $product->listing_thumb)
// 		return $img_path . $product->listing_thumb;
	
// 	else if($location == 'product' && $product->preview_thumb)
// 		return $img_path .  $product->preview_thumb;
	
// 	return $product->preview_thumb ? $img_path . $product->preview_thumb : $product->image;
// }

function product_thumb($product, $location = FALSE)
{
	$img_path 	= '/img/t-shirts/';
	$prod_path 	= '/img/products/';

	if($location == 'listing' && $product->image)
	{
		return $prod_path . $product->image;
	}
	
	else if($location == 'product' && $product->preview_thumb)
		return $img_path .  $product->preview_thumb;
	
	return $product->preview_thumb ? ($img_path . $product->preview_thumb) : ($prod_path . $product->image);
}

function surface_thumb($surface)
{
	$path = '/img/surfaces/';

	// if(preg_match('/(hoodie|hoody)/ims', $surface->name) && !$surface->image)
	// {
	// 	return $path . 'HOODIE.png';
	// }
	// elseif(preg_match('/tote/ims', $surface->name) && !$surface->image)
	// {
	// 	return $path . 'TOTE.png';
	// }
	// elseif(preg_match('/T\-shirt/ims', $surface->name) && !$surface->image)
	// {
	// 	return $path . 'T-SHIRT.png';
	// }
	// elseif($surface->type == 'EMBROIDERY')
	// {
	// 	return $path . 'EMBROIDERY.png';
	// }
	
	return $path . $surface->image;

	$ci = &get_instance();

	$path = '/img/surfaces/';

	return $path . $surface->slug . '.png';
}

function surfaces_url($tpl)
{
	$ci = &get_instance();

	$path = '/' . $ci->data['lastname'] . '/' . $tpl->slug;

	return $path;
}

function products_url($template, $surface)
{
	$ci = &get_instance();

	return '/' . $ci->data['lastname'] . '/' . $template->slug . '/' . $surface->slug; 
}

function product_url($lastname, $template, $surface, $product)
{
	$ci = &get_instance();
	
	return '/' . $lastname . '/' . $template->slug . '/' . $surface->slug . '/' . $product->id;
}

function format_price($price)
{
	return '$' . number_format($price, 2);
}

function catalog_price($price, $our_price)
{
	return $price + $our_price;
}

function image_from_data_url($data, $save_path, $ext = '.png')
{
	if(!strstr($data, 'data:image/png;base64'))
		return FALSE;

    $data        = str_replace('data:image/png;base64,', '', $data);
    $data        = str_replace(' ', '+', $data);

    $filename   = random_string('alnum', 10) . $ext;

    write_file(
        $save_path . $filename, base64_decode($data)
    );

    return $filename;
}

function saved_logo_url($logo)
{
	$ci 	= &get_instance();
	$ci->load->config('amazon_config');

	return sprintf(
		'%s/%s/%s/%s',
		'https://s3.amazonaws.com', $ci->config->item('bucket'),
		$ci->config->item('saved_logos_folder'), $logo->filename
	);
}

function downloadable_product($item)
{
	return $item->product_type == 'DIGITAL-PRODUCT';
}

function download_product_url($product)
{
	return site_url('catalog/download_product') . '?id=' . $product->id;
}

function is_printfull_product($product_type)
{
	if(downloadable_product((object) array('product_type' => $product_type)))
		return FALSE;

	if(in_array($product_type, array('PHONE-CASE', 'BIB', 'APRON')))
		return FALSE;

	return TRUE;
}

function is_printaura_product($product_type)
{
	if(downloadable_product((object) array('product_type' => $product_type)))
		return FALSE;

	if(!in_array($product_type, array('PHONE-CASE', 'BIB', 'APRON')))
		return FALSE;

	return TRUE;
}