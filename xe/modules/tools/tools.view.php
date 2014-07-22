<?php
class toolsView extends tools {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispToolsIndex() {
		
		$oModel = &getModel('tools');
		
		$args = null;
		$args->order_type = 'desc';
		$output = $oModel->selectToolsList($args);
		if ($output->toBool() && $output->data) {
			Context::set('tools_list', $output->data);
		}
		
		$this->setTemplateFile('tools');
	}
}
?>