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
		$data=array(
			'name'=>$product->name,
			'price'=>$product->price,
			'manufacture'=>$product->manufacture,
			'image'=>$product->image,
			'detail'=>$product->detail,
			'inventory_number'=>$product->inventory_number,
			'sale_number'=>$product->sale_number,
			'show'=>$product->show,
			'date'=>$product->date,
		);

		$this->tableGateway->insert($data);
	}

	public function updateProduct(Product $product)
	{
		$id=(int)$product->id;
		if($this->getProduct($id, 'id'))
		{
			$data=array(
				'name'=>$product->name,
				'price'=>$product->price,
				'manufacture'=>$product->manufacture,
				'image'=>$product->image,
				'detail'=>$product->detail,
				'inventory_number'=>$product->inventory_number,
				'sale_number'=>$product->sale_number,
				'show'=>$product->show,
				'date'=>$product->date,
			);

			$this->tableGateway->update($data, array('id'=>$id));
			return true;
		}
		return false;
	}

	public function deleteProduct($id)
	{
		$id=(int)$id;
		$this->tableGateway->delete(array('id'=>$id));
	}
}