<?php
namespace Admin\Model;

class User
{
	public $id;
	public $email;
	public $pass;
	public $name;
	public $address;
	public $tel;
	public $status;
	public $admin;

	public function exchangeArray($data)
	{
		$this->id=(!empty($data['id'])) ? $data['id']:null;
		$this->email=(!empty($data['email'])) ? $data['email']:null;
		$this->pass=(!empty($data['pass'])) ? $data['pass']:null;
		$this->name=(!empty($data['name'])) ? $data['name']:null;
		$this->address=(!empty($data['address'])) ? $data['address']:null;
		$this->tel=(!empty($data['tel'])) ? $data['tel']:null;
		$this->status=(!empty($data['status'])) ? $data['status']:null;
		$this->admin=(!empty($data['admin'])) ? $data['admin']:null;
	}
}