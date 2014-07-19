<?php
    class myipModel extends myip {
    	function init() {
    	}
    	function getModulesInfo() {
    		static $module_info = null;
    		if(is_null($module_info)) {
    			// module_config에서 값을 가져온다.
    			$oModuleModel = &getModel('module');
    			$module_info = $oModuleModel->getModuleConfig('myip');

    			// module_srl을 기준으로 스킨정보를 가져온다.
    			$skin_info->module_srl = $module_info->module_srl;
    			$oModuleModel->syncSkinInfoToModuleInfo($module_info);
    			if(count($skin_info)) foreach($skin_info as $key => $val) $module_info->{$key} = $val;

    			// mid값을 기준으로 modules에서 정보를 추출함
    			$dummy = $oModuleModel->getModuleInfoByMid($module_info->mid);
    			$module_info->module_srl    = $dummy->module_srl;
    			$module_info->layout_srl    = $dummy->layout_srl;
    			$module_info->site_srl      = $dummy->site_srl;
    			$module_info->skin          = $dummy->skin;
    			$module_info->browser_title = $dummy->browser_title;
    			$module_info->is_default    = $dummy->is_default;

    			unset($module_info->grants);
    		}
    		return $module_info;
    	}
    }
?>