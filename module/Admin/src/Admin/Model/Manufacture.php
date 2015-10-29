<?php
namespace Admin\Model;

class Manufacture
{
	public $id;
	public $name;
	public $address;
	public $tel;

	public function exchangeArray($data)
	{
		$this->id=(!empty($data['id']))?$data['id']:null;
		$this->name=(!empty($data['name']))?$data['name']:null;
		$this->address=(!empty($data['address']))?$data['address']:null;
		$this->tel=(!empty($data['tel']))?$data['tel']:null;
	}
}