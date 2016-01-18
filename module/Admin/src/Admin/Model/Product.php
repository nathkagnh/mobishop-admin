<?php
namespace Admin\Model;

class Product
{
	public $id;
	public $name;
	public $price;
	public $manufacture;
	public $inventory_number;
	public $sale_number;
	public $date;
	public $show;
	public $images;
	public $display;
	public $os;
	public $cpu;
	public $camera;
	public $internal_memory;
	public $ram;
	public $battery;
	public $more;

	public function exchangeArray($data)
	{
		$this->id=(!empty($data['id']))?$data['id']:null;
		$this->name=(!empty($data['name']))?$data['name']:null;
		$this->price=(!empty($data['price']))?$data['price']:0;
		$this->manufacture=(!empty($data['manufacture']))?$data['manufacture']:null;
		$this->inventory_number=(!empty($data['inventory_number']))?$data['inventory_number']:0;
		$this->sale_number=(!empty($data['sale_number']))?$data['sale_number']:0;
		$this->date=(!empty($data['date']))?$data['date']:null;
		$this->show=(!empty($data['show']))?$data['show']:0;
		$this->images=(!empty($data['images']))?$data['images']:null;
		$this->display=(!empty($data['display']))?$data['display']:null;
		$this->os=(!empty($data['os']))?$data['os']:null;
		$this->cpu=(!empty($data['cpu']))?$data['cpu']:null;
		$this->camera=(!empty($data['camera']))?$data['camera']:null;
		$this->internal_memory=(!empty($data['internal_memory']))?$data['internal_memory']:null;
		$this->ram=(!empty($data['ram']))?$data['ram']:null;
		$this->battery=(!empty($data['battery']))?$data['battery']:null;
		$this->more=(!empty($data['more']))?$data['more']:null;
	}
}