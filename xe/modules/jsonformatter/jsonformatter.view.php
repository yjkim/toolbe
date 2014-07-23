<?php
class jsonformatterView extends jsonformatter {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispJsonformatterIndex() {
		$this->setTemplateFile('jsonformatter');
	}
}
?>