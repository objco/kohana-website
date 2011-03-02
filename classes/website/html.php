<?php defined('SYSPATH') or die('No direct script access.');

class Website_HTML extends Kohana_HTML {
	
	/**
	 * Creates a style sheet link element.
	 *
	 * [!] Modified to allow for IE conditional commenting.
	 *
	 *     echo HTML::style('media/css/screen.css');
	 *
	 * @param   string   file name
	 * @param   array    default attributes
	 * @param   mixed    protocol to pass to URL::base()
	 * @param   boolean  include the index page
	 * @return  string
	 * @uses    URL::base
	 * @uses    HTML::attributes
	 */
	public static function style($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		if (isset($attributes['conditional']))
		{
			$conditional = $attributes['conditional'];
			unset($attributes['conditional']);
			
			return '<!--['.$conditional.']>'.parent::style($file, $attributes, $protocol, $index).'<![endif]-->';
		}
		else
		{
			return parent::style($file, $attributes, $protocol, $index);
		}
	}
	
	/**
	 * Creates a script link.
	 *
	 * [!] Modified to allow for IE conditional commenting.
	 *
	 *     echo HTML::script('media/js/jquery.min.js');
	 *
	 * @param   string   file name
	 * @param   array    default attributes
	 * @param   mixed    protocol to pass to URL::base()
	 * @param   boolean  include the index page
	 * @return  string
	 * @uses    URL::base
	 * @uses    HTML::attributes
	 */
	public static function script($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		if (isset($attributes['conditional']))
		{
			$conditional = $attributes['conditional'];
			unset($attributes['conditional']);
			
			return '<!--['.$conditional.']>'.parent::script($file, $attributes, $protocol, $index).'<![endif]-->';
		}
		else
		{
			return parent::script($file, $attributes, $protocol, $index);
		}
	}
}