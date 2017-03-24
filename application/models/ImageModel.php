<?php
class ImageModel extends CI_Model
{
	private $table = 'photo';
	private $limit = 15;

	public function __construct()
	{
		parent::__construct();
	}

	//获取图片列表
	public function getImageList(int $page = 1, int $limit = null, string $keyword = '')
	{
		$page = $page ?? 1;
		$limit = $limit ?? $this->limit;
		$where = $keyword ? "p.title like '%$keyword%' or p.description like '%$keyword%'" : '';

		//获取总数
		// $row = $this->db->get($this->table)->num_rows();
		if($where)
			$this->db->where($where);
		$row = $this->db->select('count(*) count')
						->join('user u', 'p.uid=u.uid')
						->get($this->table.' p')
						->result_array();

		if($row[0]['count']) {
			$totalPage = ceil($row[0]['count'] / $this->limit);
			$page = $page > $totalPage ? $totalPage : $page;
			$start = ($page - 1) * $limit;

			//获取内容
			if($where)
				$this->db->where($where);
			$data = $this->db->select('p.photo_id,u.uid,p.title,p.description,p.image,u.uname')
							 ->join('user u', 'p.uid=u.uid')
							 ->limit($limit, $start)
							 ->get($this->table.' p')
							 ->result_array();		//result返回objec，reseult_array返回数组
			$list = ['data' => $data, 'totalPage' => $totalPage, 'totalRow' => $row];
			return $list;
		}
		return ['data' => [], 'totalPage' => 0, 'totalRow' => 0];
	}

	//获取图片详情
	public function getImageInfo(int $photo_id = null)
	{
		if($photo_id) {
			$data = $this->db->select('p.photo_id,u.uid,p.title,p.description,p.image,u.uname')
					 ->join('user u', 'p.uid=u.uid')
					 ->where('p.photo_Id=' .$photo_id)
					 ->get($this->table.' p')
					 ->result_array();
			return $data;
		}
		return [];
	}
}