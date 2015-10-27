<?php
namespace Admin\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class UserTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway=$tableGateway;
	}

	public function fetchAll($paginated=false)
	{
		if($paginated)
		{
			$select=new Select('User');
			$resultSetProtoType=new ResultSet();
			$resultSetProtoType->setArrayObjectProtoType(new User());
			$paginatorAdapter=new DbSelect($select, $this->tableGateway->getAdapter(), $resultSetProtoType);
			$paginator=new Paginator($paginatorAdapter);
			return $paginator;
		}
		$resultSet=$this->tableGateway->select();
		return $resultSet;
	}

	public function getUserByEmail($email)
	{
		$rowset=$this->tableGateway->select(array('email'=>$email));
		$row=$rowset->current();
		if(!$row)
			return null;
		return $row;
	}

	public function getUserById($id)
	{
		$id=(int)$id;
		$rowset=$this->tableGateway->select(array('id'=>$id));
		$row=$rowset->current();
		if(!$row)
			return null;
		return $row;
	}

	public function insertUser(User $user)
	{
		$data=array(
			'email'=>$user->email,
			'pass'=>$user->pass,
			'name'=>$user->name,
			'address'=>$user->address,
			'tel'=>$user->tel,
			'status'=>$user->status,
			'admin'=>$user->admin,
		);
		if(!$this->getUserByEmail($user->email))
		{
			$this->tableGateway->insert($data);
			return 1;
		}
		else return 0;
		// else throw new \Exception('User is exits');
	}

	public function updateUser(User $user)
	{
		$data=array(
			'pass'=>$user->pass,
			'name'=>$user->name,
			'address'=>$user->address,
			'tel'=>$user->tel,
			'status'=>$user->status,
			'admin'=>$user->admin,
		);
		if($this->getUserById($user->id))
		{
			$this->tableGateway->update($data, array('id'=>$user->id));
			return 1;
		}
		else return 0;
		// else throw new \Exception('User is not exits');
	}

	public function deleteUser($id)
	{
		$id=(int)$id;
		$this->tableGateway->delete(array('id'=>$id));
	}

}