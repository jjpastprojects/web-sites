<?php

function parse_csv($path, $length = 0, $delimeter = ',', $enclosure = '"')
{
    $result = array();
     
    if (($handle = fopen($path, FOPEN_READ)) !== FALSE)
    {
       while (($data = fgetcsv($handle, $length, $delimeter, $enclosure)) !== FALSE)
       {
           $result[] = $data;
       }
        
        fclose($handle);
    }
    else
    {
        return FALSE;
    }
    
    return $result;
}

function json_reply($success = TRUE, $msg = '', $additional = array())
{
    $arr['success'] = $success;
    
    if($msg)
        $arr['msg'] = $msg;
    
    if($additional)
        $arr = array_merge($arr, $additional);
    
    echo json_encode($arr);
    exit;
}

function sinlural($count, $word)
{
    return $count . ' ' . ($count > 1 ? plural($word) : singular($word));
}

function isPostMethod()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function array_transparent($arr_data, $sByKey, $bOneInRows = false)
{
    if(!is_array($arr_data)) return false;
    $arr_data_t = array();
    for($l=0;$l<count($arr_data);$l++)
    {
        if($bOneInRows)
        $arr_data_t[$arr_data[$l][$sByKey]] = $arr_data[$l];
        else
        $arr_data_t[$arr_data[$l][$sByKey]][] = $arr_data[$l];
    }
    return  $arr_data_t;
}

function object_transparent($arr_data, $sByKey, $bOneInRows = false)
{
    if(!is_array($arr_data)) return false;
    $arr_data_t = array();

    for($l = 0; $l <count($arr_data); $l++)
    {
        if($bOneInRows)
            $arr_data_t[$arr_data[$l]->$sByKey] = $arr_data[$l];
        else
            $arr_data_t[$arr_data[$l]->$sByKey][] = $arr_data[$l];
    }

    return  $arr_data_t;
}

require 'vendor/autoload.php';
use Omnipay\Omnipay;

function get_payment_gateway($gw)
{
    $gateway    = FALSE;
    $CI         = & get_instance();

    switch($gw)
    {
        case 'Stripe':
        {
            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey($CI->config->item('stripe_api_key'));
        } break;

        case 'PayPal_Express':
        {

            
            // $gateway = Omnipay::create('PaypalRest');


            // $gateway->setClientId($CI->config->item('pp_client_id'));
            // $gateway->setSecret($CI->config->item('pp_secret'));

            // // $gateway->setSignature($CI->config->item('pp_signature'));
            // $gateway->setTestMode($CI->config->item('pp_test_mode'));


            $gateway = Omnipay::create($gw);
            $gateway->setUsername($CI->config->item('pp_username'));
            $gateway->setPassword($CI->config->item('pp_password'));

            $gateway->setSignature($CI->config->item('pp_signature'));
            $gateway->setTestMode($CI->config->item('pp_test_mode'));
        } break;
    }

    return $gateway;
}

function format_date($date, $format = 'Y/m/d h:i A')
{
    if(!is_numeric($date))
        $date = strtotime($date);

    return date($format, $date);
}

function relative_date($time, $timeformat = 'g:i A')
{
    if($time == '0000-00-00 00:00:00')
        return '-';
    
    if(!is_numeric($time))
        $time = strtotime($time);
        
    $today = strtotime(date('M j, Y'));

    $reldays = ($time - $today)/86400;

    if ($reldays >= 0 && $reldays < 1)
    {
        // return date($timeformat, $time);
        return 'Today';

    } else if ($reldays >= 1 && $reldays < 2) {

    return 'Tomorrow, ' . date($timeformat, $time);

    } else if ($reldays >= -1 && $reldays < 0) {

    return 'Yesterday';

    }

    if (abs($reldays) < 7) {

        if ($reldays > 0) {

        $reldays = floor($reldays);

        return 'In ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');

        } else {

        $reldays = abs(floor($reldays));

        return $reldays . ' day' . ($reldays != 1 ? 's' : '') . ' ago';

        }

    }

    if (abs($reldays) < 182) {

        return date('l, j F Y', $time ? $time : time());

    } else {

        return date('l, j F, Y',$time ? $time : time());

    }

}

function time_elapsed_string($ptime, $never = 'never')
{
    if(!$ptime)
        return $never;

    if(!is_numeric($ptime))
        $ptime = strtotime($ptime);
    
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}

function make_slug($str, $options = array()) {
    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => false,
    );
    
    // Merge options
    $options = array_merge($defaults, $options);
    
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
        'ß' => 'ss', 
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
        'ÿ' => 'y',
 
        // Latin symbols
        '©' => '(c)',
 
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
 
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 
 
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
 
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
 
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
        'Ž' => 'Z', 
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z', 
 
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
        'Ż' => 'Z', 
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
 
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    
    // Make custom replacements
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    
    // Transliterate characters to ASCII
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    
    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    
    // Remove duplicate delimiters
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    
    // Truncate slug to max. characters
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    
    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);
    
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function bits($set, $find)
{
    return intval($set) & intval($find);
}

function rsa_sha1_sign($policy, $private_key_filename) {
    $signature = "";

    // load the private key
    $fp = fopen($private_key_filename, "r");
    $priv_key = fread($fp, 8192);
    fclose($fp);
    $pkeyid = openssl_get_privatekey($priv_key);

    // compute signature
    openssl_sign($policy, $signature, $pkeyid);

    // free the key from memory
    openssl_free_key($pkeyid);

    return $signature;
 }

function url_safe_base64_encode($value) {
    $encoded = base64_encode($value);
    // replace unsafe characters +, = and / with 
    // the safe characters -, _ and ~
    return str_replace(
        array('+', '=', '/'),
        array('-', '_', '~'),
        $encoded);
}

function get_canned_policy_stream_name($video_path, $private_key_filename, $key_pair_id, $expires) {
    // this policy is well known by CloudFront, but you still need to sign it, 
    // since it contains your parameters
    $canned_policy = '{"Statement":[{"Resource":"' . $video_path . '","Condition":{"DateLessThan":{"AWS:EpochTime":'. $expires . '}}}]}';
    // the policy contains characters that cannot be part of a URL, 
    // so we Base64 encode it
    $encoded_policy = url_safe_base64_encode($canned_policy);
    // sign the original policy, not the encoded version
    $signature = rsa_sha1_sign($canned_policy, $private_key_filename);
    // make the signature safe to be included in a url
    $encoded_signature = url_safe_base64_encode($signature);

    $stream_name = 'Expires=' . $expires;
    $stream_name .= '&Signature=' . $encoded_signature . '&Key-Pair-Id=' . $key_pair_id;
    // url-encode the query string characters to work around a flash player bug
    return ($stream_name);
}

function get_signed_cloudfront_url($url, $expires = FALSE)
{
    $ci = & get_instance();

    return $url . '?' . get_canned_policy_stream_name(
        $url,
        $ci->config->item('cloudfront_keypair_file'),
        $ci->config->item('cloudfront_keypair_id'),
        ($expires ? $expires : strtotime('now + 1 hour'))
    );
}

function safe_unlink($path)
{
    if(file_exists($path))
        return unlink($path);

    return FALSE;
}

function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}

function mysql_now_date()
{
    return date('Y-m-d H:i:s');
}

function percent($num, $percent)
{
    return $num / 100 * $percent;
}

function xtract_data($data, $key)
{
    if(!$data)
        return array();

    $return = array();

    foreach($data as $v)
        $return[] = $v->$key;

    return $return;
}

function custom_number_format($n, $precision = 0) {
    if ($n < 1000) {
        $n_format = number_format($n);
    } else if ($n < 1000000) {
        $n_format = number_format($n / 1000, $precision) . 'K';
    } else if ($n < 1000000000) {
        
        $n_format = number_format($n / 1000000, $precision) . 'M';
    } else {
        $n_format = number_format($n / 1000000000, $precision) . 'B';
    }

    return $n_format;
}

function is_mobile()
{
    require_once(APPPATH . 'libraries/Mobile_Detect.php');

    $detect = new Mobile_Detect;
    return $detect->isMobile();
}