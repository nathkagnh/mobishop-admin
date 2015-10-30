<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class ProductTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tb)
	{
		$this->tableGateway=$tb;
	}

	public function fetchAll()
	{
		$resultSet=$this->tableGateway->select();
		return $resultSet;
	}

	public function getProduct($data, $type)
	{
		if($type=='id')
			$data=(int)$data;
		$resultSet=$this->tableGateway->select(array("$type"=>$data));
		$result=$resultSet->current();
		if(!$result)
			return null;
		return $result;
	}

	public function insertProduct(Product $product)
	{

	}

	public function updateProduct(Product $product)
	{
		
	}

	public function deleteProduct($id)
	{
		
	}
}