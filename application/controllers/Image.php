<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	//获取图片列表
	public function list()
	{
		// var_dump($_SERVER['HTTP_TOKEN']);

		$page = $this->input->post('page');
		$keywords = $this->input->post('keywords');
		$keywords = trim($keywords);
		if( !preg_match('/^\d*$/', $page) || $page <= 0) {
			$page = 1;
		}

		if(empty($keywords)) {
			$keywords = '';
		}

		$this->load->model('ImageModel');
		$data = $this->ImageModel->getImageList($page, null, $keywords);
		exit(json_encode($data));
	}

	//获取图片详情
	public function info()
	{
		$pid = $this->input->post('pid');
		if( !preg_match('/^\d*$/', $pid) || $pid <= 0) {
			exit('error');
		}

		$this->load->model('ImageModel');
		$info = $this->ImageModel->getImageInfo($pid);
		exit(json_encode($info));
	}

	//添加图片
	public function addImage()
	{
		//图片上传，支持批量，最多10个，获取数组内容
		$this->input->post('file');
	}
}