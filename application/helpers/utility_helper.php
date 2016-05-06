<?php

if (!function_exists('asset_url'))
{
	function asset_url($uri = '')
	{
		return base_url(get_instance()->config->item('asset_url') . $uri);
	}
}

if (!function_exists('load_language'))
{
	function load_language()
	{
		$numargs = func_num_args();
		$ci = get_instance();

		if ($numargs == 1) {
			foreach ($ci->config->item('language_files') as $file) {
				$ci->lang->load($file, func_get_arg(0));
			}
		} else if ($numargs > 1) {
			$args = func_get_args();
			for ($i = 1; $i < $numargs; $i++) {
				$ci->lang->load($args[$i], func_get_arg(0));
			}
		}
	}
}

if (!function_exists('get_cookie_array'))
{
	function get_cookie_array($index)
	{
		$ci = get_instance();

		$cookie = $ci->input->cookie($index);

		if ($cookie == null) {
			return null;
		}

		$cookie = stripslashes($cookie);
		return json_decode($cookie, true);
	}
}

if (!function_exists('get_settings_item'))
{
	function get_settings_item($usertype, $index)
	{
		$ci = get_instance();

		$array = get_cookie_array($ci->config->item('cookie_prefix') . $usertype . '_settings');
		
		if (!isset($array)) {
			return null;
		}

		if ($index != null && isset($array[$index])) {
			return $array[$index];
		}

		return null;
	}
}

if (!function_exists('html_breaks'))
{
	function html_breaks($str)
	{
		$str = str_replace('\r', '&#013;', $str);
		return str_replace('\n', '&#010;', $str);
	}
}

if (!function_exists('var_dump_str'))
{
	function var_dump_str($var)
	{
		ob_start();
		var_dump($var);
		return ob_get_clean();
	}
}

if (!function_exists('rrmdir'))
{
	function rrmdir($dir) 
	{ 
		foreach (glob($dir . '/*') as $file) { 
			if (is_dir($file)) {
				rrmdir($file);
			} else {
				unlink($file);
			} 
		} 

		if (is_dir($dir)) {
			rmdir($dir); 
		}
	}
}

if (!function_exists('partner_has_permission'))
{
	function partner_has_permission($type)
	{
		$ci = get_instance();

		switch ($type) {
			case 'feed':
				$key = 'company_permission_feed';
				break;
			case 'jobs':
				$key = 'company_permission_jobs';
				break;
			case 'statistics':
				$key = 'company_permission_statistics';
				break;
			case 'advertisements':
				$key = 'company_permission_advertisements';
				break;
			case 'members':
				$key = 'company_permission_members';
				break;
		}

		return (isset($key) && !empty($key) && array_key_exists($key, $ci->session->partner) && !is_null($ci->session->partner[$key]) && is_numeric($ci->session->partner[$key]) && intval($ci->session->partner[$key]) > 0);
	}
}