<?php
class toolsView extends tools {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispToolsIndex() {
		$this->setTemplateFile('tools');
	}
}
?>