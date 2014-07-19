<?php
class mimetoolView extends mimetool {
	
	function init() {
		$template_path = sprintf("%sskins/%s/",$this->module_path, "default");
		$this->setTemplatePath($template_path);
	}
	
	
	function dispMimetoolIndex() {
		
		$input = Context::get('input');
		$download = Context::get('download');
		
		Context::set('url_encode',urlencode($input));
		Context::set('url_decode',urldecode($input));
		Context::set('base64_encode',base64_encode($input));
		Context::set('base64_decode',base64_decode($input));
		Context::set('quoted_encode',$this->quoted_printable_encode($input));	// php 에 quoted_printable_encode 가 없음
		Context::set('quoted_decode',quoted_printable_decode($input));
		
		$this->setTemplateFile('mimetool');
	}
	
	function dispMimetoolUrlEncodeDownload() {

		$input = $_POST['inputStr'];
		$output = urlencode($input);
		$len = strlen($output);
		
		Header("Content-type:application/octet-stream");
		Header("Content-Length:" . $len);
		Header("Content-Disposition:attachment;filename=" . "urlenc.txt");
		Header("Content-type:file/unknown");
		Header("Content-Transfer-Encoding:binary");
		Header("Pragma:no-cache");
		Header("Expire:0");
		
		echo $output;
		die();
	}
	function dispMimetoolUrlDecodeDownload() {

		$input = $_POST['inputStr'];
		$output = urldecode($input);
		$len = strlen($output);
		
		Header("Content-type:application/octet-stream");
		Header("Content-Length:" . $len);
		Header("Content-Disposition:attachment;filename=" . "urldec.txt");
		Header("Content-type:file/unknown");
		Header("Content-Transfer-Encoding:binary");
		Header("Pragma:no-cache");
		Header("Expire:0");
		
		echo $output;
		die();
	}

	function dispMimetoolBase64EncodeDownload() {
	
		$input = $_POST['inputStr'];
		$output = base64_encode($input);
		$len = strlen($output);
	
		Header("Content-type:application/octet-stream");
		Header("Content-Length:" . $len);
		Header("Content-Disposition:attachment;filename=" . "base64enc.txt");
		Header("Content-type:file/unknown");
		Header("Content-Transfer-Encoding:binary");
		Header("Pragma:no-cache");
		Header("Expire:0");
	
		echo $output;
		die();
	}
	function dispMimetoolBase64DecodeDownload() {
	
		$input = $_POST['inputStr'];
		$output = base64_decode($input);
		$len = strlen($output);
	
		Header("Content-type:application/octet-stream");
		Header("Content-Length:" . $len);
		Header("Content-Disposition:attachment;filename=" . "base64dec.txt");
		Header("Content-type:file/unknown");
		Header("Content-Transfer-Encoding:binary");
		Header("Pragma:no-cache");
		Header("Expire:0");
	
		echo $output;
		die();
	}
	function dispMimetoolQuotedPrintableEncodeDownload() {
	
		$input = $_POST['inputStr'];
		$output = $this->quoted_printable_encode($input);
		$len = strlen($output);
	
		Header("Content-type:application/octet-stream");
		Header("Content-Length:" . $len);
		Header("Content-Disposition:attachment;filename=" . "qpenc.txt");
		Header("Content-type:file/unknown");
		Header("Content-Transfer-Encoding:binary");
		Header("Pragma:no-cache");
		Header("Expire:0");
	
		echo $output;
		die();
	}
	function dispMimetoolQuotedPrintableDecodeDownload() {
	
		$input = $_POST['inputStr'];
		$output = quoted_printable_decode($input);
		$len = strlen($output);
	
		Header("Content-type:application/octet-stream");
		Header("Content-Length:" . $len);
		Header("Content-Disposition:attachment;filename=" . "qpdec.txt");
		Header("Content-type:file/unknown");
		Header("Content-Transfer-Encoding:binary");
		Header("Pragma:no-cache");
		Header("Expire:0");
	
		echo $output;
		die();
	}
}
?>