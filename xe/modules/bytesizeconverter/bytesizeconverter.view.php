<?php
class bytesizeconverterView extends bytesizeconverter {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispBytesizeconverterIndex() {
		$this->setTemplateFile('bytesizeconverter');
	}
}
?>