<?php
class toolsAdminView extends tools {
	function init() {
		// 모듈정보를 가져온다.
		$oToolsModel = &getModel('tools');
		$this->module_info = $oToolsModel->getModulesInfo();
		Context::set('module_info',$this->module_info);
	
		// 템플릿정보를 가져온다.
		$this->setTemplatePath($this->module_path."/tpl/");
		$template_path = sprintf("%stpl/",$this->module_path);
		$this->setTemplatePath($template_path);
	}
	
	function dispToolsAdminSetup() {
		// 회원그룹목록가져오기
		$oMemberModel = &getModel('member');
		$output = $oMemberModel->getGroups();
		Context::set('group_list', $output);

		// 스킨목록가져오기
		$oModuleModel = &getModel('module');
		$skin_list = $oModuleModel->getSkins($this->module_path);
		Context::set('skin_list',$skin_list);

		// 레이아웃 목록가져오기
		$oLayoutMode = &getModel('layout');
		$layout_list = $oLayoutMode->getLayoutList();
		Context::set('layout_list', $layout_list);

		// 템플릿파일이름 정하기
		$this->setTemplateFile('setup');
	}

	function dispToolsAdminGrantInfo() {
		// 공통 모듈 권한 설정 페이지 호출
		$oModuleAdminModel = &getAdminModel('module');
		$grant_content = $oModuleAdminModel->getModuleGrantHTML($this->module_info->module_srl, $this->xml_info->grant);
		Context::set('grant_content', $grant_content);

		$this->setTemplateFile('grant_list');
	}
}
?>