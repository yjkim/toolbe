<?php
class domaincheckView extends domaincheck {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispDomaincheckIndex() {
		$this->setTemplateFile('domaincheck');
	}
}
?>