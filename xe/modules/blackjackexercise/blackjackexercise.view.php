<?php
class blackjackexerciseView extends blackjackexercise {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispBlackjackexerciseIndex() {
		
		// 2,3,4,5,6,7,8,9,10,A 순서
		$table = array(
				'under8' => array('H','H','H','H','H','H','H','H','H','H'),
				'9' =>      array('H','D','D','D','D','H','H','H','H','H'),
				'10' =>     array('D','D','D','D','D','D','D','D','H','H'),
				'11' =>     array('D','D','D','D','D','D','D','D','D','H'),
				'12' =>     array('H','H','S','S','S','H','H','H','H','H'),
				'13' =>     array('S','S','S','S','S','H','H','H','H','H'),
				'14' =>     array('S','S','S','S','S','H','H','H','H','H'),
				'15' =>     array('S','S','S','S','S','H','H','H','SR/H','H'),
				'16' =>     array('S','S','S','S','S','H','H','SR/H','SR/H','SR/H'),
		);
		
		$this->setTemplateFile('blackjackexercise');
	}
}
?>