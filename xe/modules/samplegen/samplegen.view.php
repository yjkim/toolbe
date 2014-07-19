<?php
class samplegenView extends samplegen {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	function dispSamplegenIndex() {
		$this->setTemplateFile('samplegen');
	}


	function recurse_copy ($src,$dst,$mname) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					$this->recurse_copy($src . '/' . $file,$dst . '/' . $file,$mname);
				}
				else {
					$srcpath = $src . '/' . $file;
					$dstfile = $file;
					if ($file == 'sample.html') {
						$dstfile = sprintf('%s.html',$mname);
					}
					if ($file == 'sample.admin.controller.php') {
						$dstfile = sprintf('%s.admin.controller.php',$mname);
					}
					if ($file == 'sample.admin.view.php') {
						$dstfile = sprintf('%s.admin.view.php',$mname);
					}
					if ($file == 'sample.class.php') {
						$dstfile = sprintf('%s.class.php',$mname);
					}
					if ($file == 'sample.model.php') {
						$dstfile = sprintf('%s.model.php',$mname);
					}
					if ($file == 'sample.view.php') {
						$dstfile = sprintf('%s.view.php',$mname);
					}
					$dstpath = $dst . '/' . $dstfile;
					copy($srcpath,$dstpath);
				}
			}
		}
		closedir($dir);
	}
	function dispSamplegenDownload() {
		
		$module_name = Context::get('module_name');
		$rand_value = rand();
		$src_path = sprintf(_XE_PATH_ . 'modules/samplegen/data/sample');
		$tmp_root = sprintf(_XE_PATH_ . 'files/tmp/samplegen/%s_%s', $module_name, $rand_value);
		$dst_root = sprintf('%s/%s', $tmp_root, $module_name);
		$download_path = sprintf(_XE_PATH_ . 'files/tmp/samplegen/%s_%s/%s.tar.gz', $module_name, $rand_value, $module_name);
		
		if (!mkdir($dst_root, 0755, true)) {
			// failed to mdkir
		}
		if (!$this->recurse_copy($src_path,$dst_root,$module_name) ) {
			// failed to copy
		}
				
		// execute string replace sciprt
		$Module_name = ucfirst($module_name);	// 첫글자만 대문자
		$cmd = sprintf('/bin/bash ' . _XE_PATH_ . 'modules/samplegen/data/gen.sh %s %s %s 2>&1',$module_name,$Module_name,$tmp_root);
		exec($cmd, $output);
		// log
		$output_path = sprintf('%s/%s.log', $tmp_root,$module_name);
		file_put_contents($output_path,print_r($output,true));
		
		// stream
		if (file_exists($download_path)) {

			$filesize = filesize($download_path);
			
			header("Pragma: public");
			header("Expires: 0");
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"$download_filename\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: $filesize");
			
			ob_clean();
			flush();
			readfile($download_path);
			
			die();
		}
		$this->setTemplateFile('samplegen');
	}
}
?>