<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('redirect_back'))
{
    function redirect_back()
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
        exit;
    }
}

if ( ! function_exists('isGet'))
{
    function isGet()
    {
		$val = FALSE;
		if (get_instance()->input->server('REQUEST_METHOD') == 'GET')
			$val = TRUE;
        return $val;
    }   
}

if (!function_exists('get_status'))
{
	function get_status()
	{
		$val = get_instance()->session->userdata('login');
		return $val['status'];
	}
}

if ( ! function_exists('isPost'))
{
    function isPost()
    {
		$val = FALSE;
		if (get_instance()->input->server('REQUEST_METHOD') == 'POST')
			$val = TRUE;
        return $val;
    }   
}


if ( ! function_exists('isAjax'))
{
    function isAjax()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }   
}

// if (!function_exists('url'))
// {
	// function url($str=''){
		// return get_instance()->config()->item('base_url'). $str;
	// }
// }

if (!function_exists('url')){
    function url($route = '', $param = ''){
        $param = (is_array($param) && count($param)) ? '&'.http_build_query($param) : '';
		$selector = $param == '' ? '' : '?';
        $base_url = get_instance()->config->item('base_url');
        $result = $base_url.$route;
        return (substr($result,-1,1) !== '/' && $param) ? $result.'/'.$selector.$param :  $result.$selector.$param;
    }
}

if (!function_exists('url_title') ) {

    /**
     * url_title()
     *
     * @param mixed $str
     * @param string $separator
     * @param bool $lowercase
     * @return
     */
    function url_title ($str, $separator = 'dash', $lowercase = true, $lenght = 200) {
        if ( $separator == 'dash' ) {
            $search = '_';
            $replace = '-';
        }
        else {
            $search = '-';
            $replace = '_';
        }

        $trans = array(
            '&\#\d+?;' => '',
            '&\S+?;' => '',
            '\s+' => $replace,
            '[^a-z0-9\-\._]' => '',
            $replace . '+' => $replace,
            $replace . '$' => $replace,
            '^' . $replace => $replace,
            '\.+$' => ''
        );

        $str = strip_tags($str);
        if ( strlen($str) > $lenght ) {
            $str = substr($str, 0, $lenght);
        }

        foreach ( $trans as $key => $val ) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }

        if ( $lowercase) {
            $str = strtolower($str);
        }

        return strtolower(trim(stripslashes(str_replace(array( ',', '.' ), array( '', '' ), $str))));
    }

}

function htmlEncode($str){
    return htmlentities($str);
}

function request($index = false, $default = false){
    if ($index === false)
        return $_REQUEST;
    return (isset($_REQUEST[$index])) ? $_REQUEST[$index] : $default;
}

function get($index = false, $default = false){
    if ($index === false)
        return $_GET;
    return (isset($_GET[$index])) ? $_GET[$index] : $default;
}

function post($index = false, $default = false){
    if ($index === false)
        return $_POST;
    return (isset($_POST[$index])) ? $_POST[$index] : $default;
}

if ( ! function_exists('echoPre')){
	function echoPre($ar=[]){
		echo "<pre>";
		print_r($ar);
		echo "</pre>";
		die();
	}
}

if ( ! function_exists('objToArr')){
	function objToArr($obj){
		if (is_object($obj)) $obj = (array)$obj;
		if (is_array($obj)) {
			$new = array();
			foreach ($obj as $key => $val) {
				$new[$key] = objToArr($val);
			}
		} else {
			$new = $obj;
		}

		return $new;
	}
}

if ( ! function_exists('integerToRoman')){
	function integerToRoman($integer){
	 // Convert the integer into an integer (just to make sure)
	 $integer = intval($integer);
	 $result = '';
	 
	 // Create a lookup array that contains all of the Roman numerals.
	 $lookup = array('M' => 1000,
	 'CM' => 900,
	 'D' => 500,
	 'CD' => 400,
	 'C' => 100,
	 'XC' => 90,
	 'L' => 50,
	 'XL' => 40,
	 'X' => 10,
	 'IX' => 9,
	 'V' => 5,
	 'IV' => 4,
	 'I' => 1);
	 
	 foreach($lookup as $roman => $value){
	  // Determine the number of matches
	  $matches = intval($integer/$value);
	 
	  // Add the same number of characters to the string
	  $result .= str_repeat($roman,$matches);
	 
	  // Set the integer to be the remainder of the integer and the value
	  $integer = $integer % $value;
	 }
	 
	 // The Roman numeral should be built, return it
	 return $result;
	}
}

function now($format_timestamp=false){
	$CI_ =& get_instance();
	$CI_->load->helper('date');
	if (!$format_timestamp)
		return date('Y-m-d H:i:s', gmt_to_local(time(), 'UP7'));
	else 
		return gmt_to_local(time(), 'UP7');
	// return date('Y-m-d H:i:s');
}

function bulan($bulan = false){
	$arr = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	if (is_numeric($bulan) && $bulan <= 12){
		return $arr[$bulan - 1];
	} else 
		return false;
	
}

function hari($hari = false){
	$arr = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu'];
	if (is_numeric($hari) && $hari <= 7){
		return $arr[$hari - 1];
	} else 
		return false;
	
}

if (!function_exists('splitKeywords')){
	function splitKeywords($text){
		$text = str_replace(' ',', ',$text);
		$text = str_replace(' | ',', ',$text);
		$text = str_replace(' - ',', ',$text);
		$text = str_replace(',, ',', ',$text);
		$text = str_replace('-, ','',$text);
		$text = str_replace('|, ','',$text);
		$text = str_replace('\'','',$text);
		$text = str_replace('!','',$text);
		$text = str_replace('?','',$text);

		return strtolower($text);
	}
}

if ( !function_exists('character_limiter') ) {

    /**
     * character_limiter()
     *
     * @param mixed $str
     * @param integer $n
     * @param string $end_char
     * @return
     */
    function character_limiter ($str, $n = 500, $end_char = '&#8230;') {
        if ( strlen($str) < $n ) {
            return $str;
        }

        $str = preg_replace("/\s+/", ' ', str_replace(array( "\r\n", "\r", "\n" ), ' ', $str));

        if ( strlen($str) <= $n ) {
            return $str;
        }

        $out = "";
        foreach ( explode(' ', trim($str)) as $val ) {
            $out .= $val . ' ';

            if ( strlen($out) >= $n ) {
                $out = trim($out);
                return (strlen($out) == strlen($str)) ? $out : $out . $end_char;
            }
        }
    }

}