<?php
/* Copyright (C) NAVER <http://www.navercorp.com> */

/**
 * @class  syndicationAdminView
 * @author NAVER (developers@xpressengine.com)
 * @brief  syndication admin view class
 **/
class syndicationAdminView extends syndication
{
	function init() {
	}

	public function dispSyndicationAdminConfig()
	{
		$oModuleModel = getModel('module');

		$module_config = $oModuleModel->getModuleConfig('syndication');
		if(!$module_config->target_services)
		{
			$module_config->target_services = array();
		}

		foreach($this->services as $key => $val)
		{
			unset($obj);
			$obj = new stdClass;
			$obj->service = $key;
			$obj->ping = $val;
			$obj->selected = in_array($key, $module_config->target_services)?true:false;
			$services[] = $obj;
		}
		Context::set('services', $services);

		if(!$module_config->site_url)
		{
			$module_config->site_url = Context::getDefaultUrl()?Context::getDefaultUrl():getFullUrl();
		}
		Context::set('site_url', preg_replace('/^(http|https):\/\//i','',$module_config->site_url));

		if(!$module_config->year)
		{
			$module_config->year = date("Y");
		}
		Context::set('year', $module_config->year);

		$output = executeQueryArray('syndication.getExceptModules');
		$except_module_list = array();
		if($output->data && count($output->data) > 0)
		{
			foreach($output->data as $item)
			{
				$except_module_list[] = $item;
			}
		}
		Context::set('except_module', $except_module_list);

		//Security
		$security = new Security();
		$security->encodeHTML('services..service','except_module..ping');
		$security->encodeHTML('except_module..mid','except_module..browser_title');

		$this->setTemplatePath($this->module_path.'tpl');
		$this->setTemplateFile('config');
	}

}
