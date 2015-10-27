<?php
namespace Admin\Model;

class Info
{
	public $name;
	public $logo;
	public $address;
	public $tel;
	public $introduce;
	public $image;

	public function exchangeArray($data)
	{
		$this->name=(!empty($data['name']))?$data['name']:null;
		$this->logo=(!empty($data['logo']))?$data['logo']:null;
		$this->address=(!empty($data['address']))?$data['address']:null;
		$this->tel=(!empty($data['tel']))?$data['tel']:null;
		$this->introduce=(!empty($data['introduce']))?$data['introduce']:null;
		$this->image=(!empty($data['image']))?$data['image']:null;
	}
}