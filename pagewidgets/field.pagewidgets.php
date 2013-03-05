<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * page widgets Field Type
 *
 * @package		Addons\Field Types
 * @author		James Doyle (james2doyle)
 * @license		MIT License
 * @link		http://github.com/james2doyle/pyro-page-widgets-field
 */
class Field_pagewidgets
{
	public $field_type_slug    = 'pagewidgets';
	public $db_col_type        = 'text';
	public $version            = '1.0.0';
	public $custom_parameters  = array('widget_area');
	public $author             = array('name'=>'James Doyle', 'url'=>'http://github.com/james2doyle/pyro-pagewidgets-field');

	// --------------------------------------------------------------------------

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('widgets/widgets');
		$this->CI->load->model('widgets/widget_m');
	}

	/**
	 * Param Widget Area
	 *
	 * @access	public
	 * @param	[string - value]
	 * @return	string
	 */
	public function param_widget_area($value = null)
	{
		$instructions = '<p class="note">'.lang('streams:pagewidgets.widget_area_instructions').'</p>';

		// get all the areas for this site
		$widget_areas = $this->CI->widget_m->get_areas();
		$widget_areas = array_for_select($widget_areas, 'slug', 'title');

		return $instructions.'<div style="float: left;">'.form_dropdown('widget_area', $widget_areas, $value).'</div>';
	}

	// --------------------------------------------------------------------------
	// what data is going to the page
	public function pre_output($input, $data)
	{
		// unserialize the form input
		$input = unserialize($input);
		// i just want ids in the right order
		$input = str_replace('widget_', '', $input[1]);
		// split them up into an array of ids
		$input = explode(',', $input);
		$output = array();
		// assign each id to the id key name
		foreach ($input as $item) {
			$output[] = array('id' => $item);
		}
		return $output;
	}

	/**
	 * Output form input
	 *
	 * @param	array
	 * @param	array
	 * @return	string
	 */
	public function form_output($data, $entry_id, $field)
	{
		$area_slug = $field->field_data['widget_area'];
		// get all the widgets that are part of the page-widgets area
		$widget_list = $this->CI->widget_m->get_by_area($area_slug);
		// put them in a select
		$widget_list = array_for_select($widget_list, 'id', 'instance_title');
		// unserialize the output
		$output = unserialize($data['value']);
		// create a blank template for the list
		$list_template = '';
		// if the list csv array is not empty
		if (strlen($output[1]) !== 0) {
			$list = explode(',', $output[1]);
			foreach ($list as $item) {
				// just get the int id
				$id = str_replace('widget_', '', $item);
				// find the name by the id
				$name = $widget_list[$id];
				// add it to the template
				$list_template .= '<li id="'.$item.'">'.$name.'</li>';
			}
		}
		// create a hidden input for the csv array
		// populate its value and populate the list
		$template = '<input type="hidden" name="'.$data['form_slug'].'[1]" value="'.$output[1].'"><ul id="widget_sorting">'.$list_template.'</ul>';
		// show me the form
		return '<div id="widget_page">'.form_multiselect($data['form_slug'].'[0][]', $widget_list, $output[0]).$template.'</div>';
	}

	public function event($field)
	{
		$this->CI->type->add_js('pagewidgets', 'widget_field.js');
		$this->CI->type->add_css('pagewidgets', 'widget_field.css');
	}

	public function pre_save($input)
	{
		// serialize the input so it all goes in one text field
		return serialize($input);
	}
}
