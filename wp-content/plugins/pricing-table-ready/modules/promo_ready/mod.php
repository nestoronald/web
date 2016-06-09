<?php
class promo_readyPrt extends modulePrt {
	
	public function init() {
		parent::init();
	}
	
	public function addWelcome() {
		$firstTimeLookedToPlugin = !installerPrt::isUsed();
		$firstTimeLookedToPlugin = false; // disable start page
				
		if($firstTimeLookedToPlugin) {
			installerPrt::setUsed();
			return $this->getView()->showWelcomePage();
		} else {
			//delete_option(PRT_DB_PREF. 're_used');
			return '';
		}
	}
	
	public function displayAdminFooter() {
		$this->getView()->displayAdminFooter();	
	}
	
	
	
}
?>