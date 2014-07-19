<?php
class {$modulename}View extends {$modulename} {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function disp{$Modulename}Index() {
		$this->setTemplateFile('{$modulename}');
	}
}
?>