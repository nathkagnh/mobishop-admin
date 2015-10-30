<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;

class ManufactureTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway=$tableGateway;
	}

	public function fetchAll()
	{
		$result=$this->tableGateway->select();
		return $result;
	}

	public function getManufacture($id)
	{
		$id=(int)$id;
		$resultSet=$this->tableGateway->select(array('id'=>$id));
		$result=$resultSet->current();
		if(!$result)
			return null;
		return $result;
	}

	public function getManufactureByName($name)
	{
		$resultSet=$this->tableGateway->select(array('name'=>$name));
		$result=$resultSet->current();
		if(!$result)
			return null;
		return $result;
	}

	public function insertManufacture(Manufacture $m)
	{
		$data=array(
			'name'=>$m->name,
			'address'=>$m->address,
			'tel'=>$m->tel,
		);
		$this->tableGateway->insert($data);
	}

	public function updateManufacture(Manufacture $m)
	{
		$data=array(
			'name'=>$m->name,
			'address'=>$m->address,
			'tel'=>$m->tel,
		);
		$id=(int)$m->id;
		if($this->getManufacture($id))
		{
			$this->tableGateway->update($data, array('id'=>$id));
			return true;
		}
		else
			return false;
	}

	public function deleteManufacture($id)
	{
		$id=(int)$id;
		$this->tableGateway->delete(array('id'=>$id));
	}
}