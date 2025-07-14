<?php
if (!function_exists('safe_strlen')) {
	function safe_strlen($str) {
		return strlen($str ?? '');
	}
}

if (!function_exists('safe_trim')) {
	function safe_trim($str) {
		return trim($str ?? '');
	}
}

if (!function_exists('safe_strpos')) {
	function safe_strpos($haystack, $needle) {
		return strpos($haystack ?? '', $needle);
	}
}

if (!function_exists('safe_str_replace')) {
	function safe_str_replace($search, $replace, $subject) {
		return str_replace($search, $replace, $subject ?? '');
	}
}
