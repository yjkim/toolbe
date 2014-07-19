<?php
class myipView extends myip {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispMyipIndex() {
		$remote_ipaddr = $_SERVER['REMOTE_ADDR'];
		Context::set('remote_ipaddr',$remote_ipaddr);
		$this->setTemplateFile('myip');
	}
}
?>