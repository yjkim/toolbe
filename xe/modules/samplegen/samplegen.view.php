<?php
class samplegenView extends samplegen {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispSamplegenIndex() {
		$this->setTemplateFile('samplegen');
	}
}
?>