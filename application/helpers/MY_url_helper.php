<?php
if ( ! function_exists('assets_url'))
{
	
	function assets_url($uri = '', $protocol = NULL)
	{
		return get_instance()->config->base_url('assets'.$uri, $protocol);
	}
}

if (!function_exists('url_cdn')){
	function url_cdn(){
		return get_instance()->config->item('cdn_url');
	}
}
?>