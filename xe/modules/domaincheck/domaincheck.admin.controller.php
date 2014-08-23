<?php
class domaincheckAdminController extends domaincheck {
	function init() {
	}

	function procDomaincheckAdminSetup() {
		//form이나 get으로 요청이 들어온 변수를 할당한다.
		$args = Context::getRequestVars(); 						// form or get
		$oModuleController = &getController('module');
		$oModuleModel = &getModel('module');

		// 기본설정가져오기
		$oDomaincheckModel = &getModel('domaincheck');
		$module_info = $oDomaincheckModel->getModulesInfo();

		// modules 테이블에 입력이 되어 있는지 체크
		$_module_info = $oModuleModel->getModuleInfoByMid($module_info->mid);

		if($module_info->mid && $_module_info) {
			$module_info->module_srl = $_module_info->module_srl;
			$is_registed = true;
		} else {
			$is_registed = false;
		}

		// mid, browser_title, is_default 값이 바뀌면 처리
		$module_info->mid = $args->mid;
		$args->module = 'domaincheck';
		$args->module_srl = $is_registed?$module_info->module_srl:getNextSequence();

		if($args->is_default == 'Y') {
			$output = $oModuleController->clearDefaultModule();
			if(!$output->toBool()) return $output;
		}

		// 입력여부에 따라 업데이트를 할지 인서트를 할지 결정
		if($is_registed) {
			$output = $oModuleController->updateModule($args);
		} else {
			$output = $oModuleController->insertModule($args);
		}
		if(!$output->toBool()) return $output;

		// module_config에 입력
		$domaincheck->mid = $args->mid;
		$output = $oModuleController->insertModuleConfig('domaincheck', $domaincheck);

		$this->setMessage("success_saved");
	}
}
?>