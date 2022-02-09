<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	if ( ! function_exists('css_url'))
	{
			function css_url($nom)
		{
			return base_url() . 'assets/css/' . $nom . '.css';
		}
	}

	if ( ! function_exists('js_url'))
	{
		function js_url($nom)
		{
			return base_url() . 'assets/js/' . $nom . '.js';
		}
	}
	
	if ( ! function_exists('img_url'))
	{
			function img_url($nom)
		{
			return base_url() . 'assets/img/' . $nom;
		}
	}

	if ( ! function_exists('fontawesome'))
	{
			function fontawesome_url($nom)
		{
			return base_url() . 'assets/icon/fontawesome/css/' . $nom;
		}
	}
	
	if ( ! function_exists('video_url'))
	{
			function video_url($nom)
		{
			return base_url() . 'assets/vid/' . $nom;
		}
	}
	
	if ( ! function_exists('img'))
	{
			function img($nom, $alt = '')
		{
			return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
		}
	}

	if ( ! function_exists('slider_img_url'))
	{
			function slider_img_url($nom)
		{
			return base_url() . 'assets/data_slide/images/' . $nom;
		}
	}

	if ( ! function_exists('slider_tooltips_url'))
	{
			function slider_tooltips_url($nom)
		{
			return base_url() . 'assets/data_slide/tooltips/' . $nom;
		}
	}

	if ( ! function_exists('vendors'))
	{
		function slider_tooltips_url($nom)
			{
				return base_url() . 'vendors/' . $nom;
			}
	}

?>