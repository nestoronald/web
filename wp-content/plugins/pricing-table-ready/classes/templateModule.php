<?php
abstract class templateModulePrt extends modulePrt {
	protected $_prevImg = 'preview.jpg';
	/**
	 * Default options for template
	 */
	protected $_defOptions = array();
	public function getPrevImgPath() {
		return $this->getModPath(). $this->_prevImg;
	}
	public function getBgCssAttrsArray() {
		$res = array(
			'height'	=> '100%',
			'margin'	=> '0 0',
			'padding'	=> '0 0',
		);
		switch(framePrt::_()->getModule('options')->get('bg_type')) {
			case 'image':
				$res['background-image'] = 'url('. framePrt::_()->getModule('options')->getBgImgFullPath(). ')';
				switch(framePrt::_()->getModule('options')->get('bg_img_show_type')) {
					case 'center':
						$res['background-position'] = 'center center';
						$res['background-repeat'] = 'no-repeat';
						break;
					case 'stretch':
						$res['background-position'] = 'center center';
						$res['background-repeat'] = 'no-repeat';
						$res['background-attachment'] = 'fixed';
						
						$res['-webkit-background-size'] = 'cover';
						$res['-moz-background-size'] = 'cover';
						$res['-o-background-size'] = 'cover';
						$res['background-size'] = 'cover';
						
						$res['filter'] = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'. framePrt::_()->getModule('options')->getBgImgFullPath(). '", sizingMethod="scale")';
						$res['-ms-filter'] = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'. framePrt::_()->getModule('options')->getBgImgFullPath(). '", sizingMethod="scale")';
						break;
					case 'tile':
						// It is tile by default in all tested browsers
						break;
				}
				break;
			case 'color':
			default:
				$res['background-color'] = framePrt::_()->getModule('options')->get('bg_color');
				break;
		}
		
		return $res;
	}
	public function getBgCssAttrs() {
		return utilsPrt::arrToCss( $this->getBgCssAttrsArray() );
	}
	
	public function getLogoImgPath() {
		return framePrt::_()->getModule('options')->isEmpty('logo_image') 
			? '' 
			: framePrt::_()->getModule('options')->getLogoImgFullPath();
	}
	public function getDefOptions($key = '') {
		if(empty($key))
			return $this->_defOptions;
		else 
			return (isset($this->_defOptions[ $key ]) ? $this->_defOptions[ $key ] : NULL);
	}
}