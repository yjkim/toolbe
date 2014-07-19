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
		$dst_root = sprintf(_XE_PATH_ . 'files/tmp/samplegen/%s_%s/', $module_name, $rand_value);
		
		if (!mkdir($dst_root, 0700, true)) {
			// failed to mdkir
			
		}
		if (!$this->recurse_copy($src_path,$dst_root,$module_name) ) {
			// failed to copy
		}
		
		
		$Module_name = ucfirst($module_name);;	// 첫글자만 대문자
		$moduletitle = $module_name;
		
		// string replace
		
		$cmd1 = 'find "'.$dst_root.'" -type f \( -name "*.php" -o -name "*.html" -o -name "*.js" -o -name "*.css" -o -name "*.xml" \) -exec sed -i -e "s/{$modulename}/'.$module_name.'/g" {} \;';
		$cmd2 = 'find "'.$dst_root.'" -type f \( -name "*.php" -o -name "*.html" -o -name "*.js" -o -name "*.css" -o -name "*.xml" \) -exec sed -i -e "s/{$Modulename}/'.$Module_name.'/g" {} \;';
		$cmd3 = 'find "'.$dst_root.'" -type f \( -name "*.php" -o -name "*.html" -o -name "*.js" -o -name "*.css" -o -name "*.xml" \) -exec sed -i -e "s/{$moduletitle}/'.$moduletitle.'/g" {} \;';
		
		system($cmd1);
		system($cmd2);
		system($cmd3);
		
		// compress
		$download_filename_tmp = sprintf('%s_%s.tar.gz',$module_name,$rand_value);
		$download_filename = sprintf('%s.tar.gz',$module_name);
		$download_path = sprintf(_XE_PATH_ . 'files/tmp/samplegen/%s', $module_name, $rand_value, $download_filename_tmp);
		
		$cmd4 = "tar -zcf $download_path $dst_root";
		system($cmd4);
		
		// stream

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
}
?>