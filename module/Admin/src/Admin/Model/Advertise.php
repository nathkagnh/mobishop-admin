<?php
namespace Admin\Model;

class Advertise
{
	public $id;
	public $location;
	public $image;
	public $link;
	public $date_start;
	public $date_end;
	public $view_count;
	public $click_count;
	public $show;

	public function exchangeArray($data)
	{
		$this->id=(!empty($data['id']))?$data['id']:null;
		$this->location=(!empty($data['location']))?$data['location']:null;
		$this->image=(!empty($data['image']))?$data['image']:null;
		$this->link=(!empty($data['link']))?$data['link']:null;
		$this->date_start=(!empty($data['date_start']))?$data['date_start']:null;
		$this->date_end=(!empty($data['date_end']))?$data['date_end']:null;
		$this->view_count=(!empty($data['view_count']))?$data['view_count']:0;
		$this->click_count=(!empty($data['click_count']))?$data['click_count']:0;
		$this->show=(!empty($data['show']))?$data['show']:0;
	}
}