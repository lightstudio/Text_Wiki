<?php

class Text_Wiki_Render_Xhtml_Table extends Text_Wiki_Render {
	
	var $conf = array(
		'css_table' => null,
		'css_tr' => null,
		'css_td' => null
	);
	
	
	/**
	* 
	* Renders a token into text matching the requested format.
	* 
	* @access public
	* 
	* @param array $options The "options" portion of the token (second
	* element).
	* 
	* @return string The text rendered from the token options.
	* 
	*/
	
	function token($options)
	{
		// make nice variable names (type, align, colspan)
		extract($options);
		
		$pad = '    ';
		
		switch ($type) {
		
		case 'table_start':
			
			// pick the CSS class
			$css = $this->getConf('css_table', '');
			if ($css) {
				$css = " class=\"$css\"";
			}
			
			// done!
			return "\n\n<table$css>\n";
			break;
		
		case 'table_end':
			return "</table>\n\n";
			break;
		
		case 'row_start':
			$html = "$pad<tr";
			
			// pick the CSS class
			$css = $this->getConf('css_tr', '');
			if ($css) {
				$css = " class=\"$css\"";
			}
			
			// done
			return "$pad<tr$css>\n";
			break;
		
		case 'row_end':
			return "$pad</tr>\n";
			break;
		
		case 'cell_start':
			
			// build the base html
			$html = "$pad$pad<td";
			
			// pick and add the CSS class
			$css = $this->getConf('css_td', '');
			if ($css) {
				$html .= " class=\"$css\"";
			}
			
			// add the column span
			if ($colspan > 1) {
				$html .= " colspan=\"$colspan\"";
			}
			
			// add alignment
			if ($align) {
				$html .= " style=\"text-align: $align;\"";
			}
			
			// done!
			$html .= '>';
			return $html;
			break;
		
		case 'cell_end':
			return "</td>\n";
			break;
		
		default:
			return '';
		
		}
	}
}
?>