<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract controller class for controllers using templates with layout support.
 * Additional feature set provides for base level website operations.
 *
 * @package    Website
 * @author     The Objective Company
 * @copyright  (c) 2010 The Objective Company
 */
abstract class Controller_Website_Webpage extends Controller_Template {

	public $template = 'templates/webpage';
	public $layout = 'empty';
	
	public $title = '';
	public $description = '';
	private $keywords = array();
	
	private $metas = array();
	private $styles = array();
	private $scripts = array();
	
	private $content = array();
	protected $pre_scripts;
	protected $post_scripts;
	
	public function before()
	{
		parent::before();
		
		if ($this->auto_render === TRUE)
		{	
			$this->template->bind('title', $this->title);
			
			$this->template->bind('metas', $this->metas);
			$this->template->bind('styles', $this->styles);
			$this->template->bind('scripts', $this->scripts);
			
			$this->template->bind('pre_scripts', $this->pre_scripts);
			$this->template->bind('post_scripts', $this->post_scripts);
			
			$this->keywords(Kohana::config('website.keywords'));
			$this->metas(Kohana::config('website.metas'));
			$this->styles(Kohana::config('website.styles'));
			$this->scripts(Kohana::config('website.scripts'));
		}
	}
	
	public function after()
	{
		if ($this->auto_render === TRUE)
		{
			$this->template->layout_class = 'layout-'.$this->layout;
			$this->template->layout = View::factory('layouts/'.$this->layout);
			
			$this->title = __(Kohana::config('website.title.prefix'));
			$this->title .= Kohana::config('website.title.prefix_separator');
			$this->title .= empty($this->title) ? Kohana::config('website.title.default') : __($this->title);
			$this->title .= Kohana::config('website.title.postfix_separator');
			$this->title .= __(Kohana::config('website.title.postfix'));
			
			if ( ! empty($this->keywords))
			{
				$this->add_meta(array('name' => 'keywords', 'content' => implode(',', $this->keywords)));
			}
		
			if ( ! empty($this->description))
			{
				$this->add_meta(array('name' => 'description', 'content' => __($this->description)));
			}	
			
			foreach ($this->content as $section => $section_contents)
			{
				foreach ($section_contents as $content)
				{
					if (isset($this->template->layout->{$section}))
					{
						$this->template->layout->{$section} .= $content;
					}
					else
					{
						$this->template->layout->{$section} = $content;
					}
				}
			}
		}
		
		parent::after();
	}
	
	protected function keywords($keywords)
	{
		foreach ($keywords as $keyword)
		{
			$this->add_keyword($keyword);
		}
	}
	
	protected function add_keyword($keyword)
	{
		$this->keywords[] = __($keyword);
	}
	
	protected function metas($metas)
	{
		foreach ($metas as $meta)
		{
			$this->add_meta($meta);
		}
	}
	
	protected function add_meta($attributes)
	{
		$this->template->metas[] = $attributes;
	}
	
	protected function styles($styles)
	{
		foreach ($styles as $style)
		{
			if (is_array($style))
			{
				$this->add_style($style[0], $style[1]);
			}
			else
			{
				$this->add_style($style);
			}
		}
	}

	protected function add_style($path, $media = 'screen')
	{
		$this->template->styles[$path] = $media;
	}
	
	protected function scripts($scripts)
	{
		foreach ($scripts as $script)
		{
			$this->add_script($script);
		}
	}
	
	protected function add_script($path)
	{
		$this->template->scripts[] = $path;
	}
	
	protected function add_content($content, $section = 'content')
	{
		$this->content[$section][] = $content;
	}

}