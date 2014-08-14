<?php
class blackjackexerciseView extends blackjackexercise {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispBlackjackexerciseIndex() {
		
		// 2,3,4,5,6,7,8,9,10,A 순서
		$tableHash = array(
				'under8' => array('H','H','H','H','H','H','H','H','H','H'),
				'9' =>      array('H','D','D','D','D','H','H','H','H','H'),
				'10' =>     array('D','D','D','D','D','D','D','D','H','H'),
				'11' =>     array('D','D','D','D','D','D','D','D','D','H'),
				'12' =>     array('H','H','S','S','S','H','H','H','H','H'),
				'13' =>     array('S','S','S','S','S','H','H','H','H','H'),
				'14' =>     array('S','S','S','S','S','H','H','H','H','H'),
				'15' =>     array('S','S','S','S','S','H','H','H','SR/H','H'),
				'16' =>     array('S','S','S','S','S','H','H','SR/H','SR/H','SR/H'),
				'over17' => array('S','S','S','S','S','S','S','S','S','S'),
				'A+2' =>    array('H','H','H','D','D','H','H','H','H','H'),
				'A+3' =>    array('H','H','H','D','D','H','H','H','H','H'),
				'A+4' =>    array('H','H','D','D','D','H','H','H','H','H'),
				'A+5' =>    array('H','H','D','D','D','H','H','H','H','H'),
				'A+6' =>    array('H','D','D','D','D','H','H','H','H','H'),
				'A+7' =>    array('S','D','D','D','D','S','S','H','H','H'),
				'A+8' =>    array('S','S','S','S','S','S','S','S','S','S'),
				'A+A' =>    array('SP','SP','SP','SP','SP','SP','SP','SP','SP','SP'),
				'2+2' =>    array('SP','SP','SP','SP','SP','SP','H','H','H','H'),
				'3+3' =>    array('SP','SP','SP','SP','SP','SP','H','H','H','H'),
				'4+4' =>    array('H','H','H','SP','SP','H','H','H','H','H'),
				'5+5' =>    array('D','D','D','D','D','D','D','D','H','H'),
				'6+6' =>    array('SP','SP','SP','SP','SP','H','H','H','H','H'),
				'7+7' =>    array('SP','SP','SP','SP','SP','SP','H','H','H','H'),
				'8+8' =>    array('SP','SP','SP','SP','SP','SP','SP','SP','SP','SP'),
				'9+9' =>    array('SP','SP','SP','SP','SP','S','SP','SP','S','S'),
				'10+10' =>  array('S','S','S','S','S','S','S','S','S','S')
		);
		
		$set = array('2','3','4','5','6','7','8','9','10','J','Q','K','A');
		$deck = array_merge($set,$set,$set,$set);
		$deck6 = array_merge($deck,$deck,$deck,$deck,$deck,$deck);
		$deck6_shuffled = $deck6;
		shuffle($deck6_shuffled);
		
		$me1 = $deck6_shuffled[0];
		$dealer1 = $deck6_shuffled[1];
		$me2 = $deck6_shuffled[2];
		$dealer2 = $deck6_shuffled[3];
		
		Context::set('tableHash',$tableHash);
		Context::set('me1',$me1);
		Context::set('dealer1',$dealer1);
		Context::set('me2',$me2);
		Context::set('dealer2',$dealer2);
		$this->setTemplateFile('blackjackexercise');
	}
	
}
?>