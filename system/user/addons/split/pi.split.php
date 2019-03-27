<?php
/*
=====================================================
Format text for ExpressionEngine
-----------------------------------------------------
v0.1: Takes "format" parameter and various values.
=====================================================
*/

if (!defined('BASEPATH')) {
	exit('No direct script access allowed.');
}

$plugin_info = array(
	'pi_name' => 'split',
	'pi_version' => '0.1',
	'pi_author' => 'EpicVoyage',
	'pi_author_url' => 'http://www.epicvoyage.org/ee',
	'pi_description' => 'Grab a text segment from a string',
	'pi_usage' => Split::usage()
);

class Split {
	var $return_data = '';

	function __construct() {
		$pattern = ee()->TMPL->fetch_param('pattern', ':');
		$num = ee()->TMPL->fetch_param('num', 1);
		$fallback = ee()->TMPL->fetch_param('fallback', 'yes');

		$values = explode($pattern, ee()->TMPL->tagdata);
		$this->return_data = trim(isset($values[$num]) ?
			$values[$num] :
			($fallback == 'yes' ? end($values) : ''));

		return;
	}

	static function usage() {
		return <<<EOF
Splits a string and returns the requested value.

Examples:
{exp:split pattern="-" num="1" fallback="no"}0-1-2-3-4-5-6-7-8-9{/exp:split}
{exp:split num="2"}Force SSL: Usage{/exp:split}
EOF;
	}

}
