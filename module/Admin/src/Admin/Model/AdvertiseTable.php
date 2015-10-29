<?php
namespace Admin\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class AdvertiseTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway=$tableGateway;
	}

	public function fetchAll()
	{
		$resultSet=$this->tableGateway->select();
		return $resultSet;
	}

	public function getAdvertiseByLocation($location)
	{
		$resultSet=$this->tableGateway->select(array('location'=>$location));
		$result=$resultSet->current();
		if(!$result)
		{
			return null;
		}
		return $result;
	}

	public function getAdvertiseById($id)
	{
		$id=(int)$id;
		$resultSet=$this->tableGateway->select(array('id'=>$id));
		$result=$resultSet->current();
		if(!$result)
		{
			return null;
		}
		return $result;
	}

	public function insertAdvertise(Advertise $ads)
	{
		$data=array(
			'location'=>$ads->location,
			'image'=>$ads->image,
			'link'=>$ads->link,
			'date_start'=>$ads->date_start,
			'date_end'=>$ads->date_end,
			'show'=>$ads->show,
		);
		$this->tableGateway->insert($data);
	}

	public function updateAdvertise(Advertise $ads)
	{
		$data=array(
			'location'=>$ads->location,
			'link'=>$ads->link,
			'date_start'=>$ads->date_start,
			'date_end'=>$ads->date_end,
			'view_count'=>$ads->view_count,
			'click_count'=>$ads->click_count,
			'show'=>$ads->show,
		);
		if(!empty($ads->image)) $data['image']=$ads->image;
		
		$id=(int)$ads->id;
		if($this->getAdvertiseById($id))
		{
			$this->tableGateway->update($data, array('id'=>$id));
			return true;
		}
		else
			return false;
	}

	public function deleteAdvertise($id)
	{
		$id=(int)$id;
		$this->tableGateway->delete(array('id'=>$id));
	}

	public function changeStatus($id, $status)
	{
		$id=(int)$id;
		if($status)
			$this->tableGateway->update(array('show'=>'1'), array('id'=>$id));
		else
			$this->tableGateway->update(array('show'=>'0'), array('id'=>$id));
	}
}