<?php
namespace Admin\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class InfoTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway=$tableGateway;
	}

	public function getInfo()
	{
		return $this->tableGateway->select(array('id'=>'1'))->current();
	}

	public function updateInfo(Info $info)
	{
		$data=array();

		if(!empty($info->name)) $data['name']=$info->name;
		if(!empty($info->logo)) $data['logo']=$info->logo;
		if(!empty($info->address)) $data['address']=$info->address;
		if(!empty($info->tel)) $data['tel']=$info->tel;
		if(!empty($info->introduce)) $data['introduce']=$info->introduce;
		if(!empty($info->image)) $data['image']=$info->image;

		if($this->getInfo())
		{
			$this->tableGateway->update($data, array('id'=>'1'));
		}
		else
		{
			$this->tableGateway->insert($data);
		}
	}
}