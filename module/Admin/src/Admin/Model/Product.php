<?php
namespace Admin\Model;

class Product
{
	public $id;
	public $name;
	public $price;
	public $manufacture;
	public $image;
	public $detail;
	public $inventory_number;
	public $sale_number;
	public $show;
	public $date;

	public function exchangeArray($data)
	{
		$this->id=(!empty($data['id']))?$data['id']:null;
		$this->name=(!empty($data['name']))?$data['name']:null;
		$this->price=(!empty($data['price']))?$data['price']:0;
		$this->manufacture=(!empty($data['manufacture']))?$data['manufacture']:null;
		$this->image=(!empty($data['image']))?$data['image']:null;
		$this->detail=(!empty($data['detail']))?$data['detail']:null;
		$this->inventory_number=(!empty($data['inventory_number']))?$data['inventory_number']:0;
		$this->sale_number=(!empty($data['sale_number']))?$data['sale_number']:0;
		$this->show=(!empty($data['show']))?$data['show']:0;
		$this->date=(!empty($data['date']))?$data['date']:null;
	}
}