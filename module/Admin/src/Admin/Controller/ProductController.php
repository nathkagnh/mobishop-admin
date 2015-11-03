<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Model\Product;

class ProductController extends AbstractActionController
{
	protected $productTable;

	protected $manufactureTable;

	public function indexAction()
	{
		$products=$this->getProductTable()->fetchAll();
		return new ViewModel(array(
			'products'=>$products,
		));
	}

	public function createAction()
	{
		$step=(int)$this->params()->fromRoute('step');
		$array=array();

		$request=$this->getRequest();

		if($request->isPost())
		{
			$post=$request->getPost();
			if(isset($post['name']))
			{
				$data=new Product();
				$data->name=$post['name'];
				$data->price=$post['price'];
				$data->manufacture=$post['manufacture'];
				$data->inventory_number=$post['inventory_number'];
				$data->date=$post['date'];
				$data->show=$post['show'];

				var_dump($this->getProductTable()->insertProduct($data));die;
			}
			else if(isset($post['image']))
			{

			}
			else
			{

			}
		}

		if($step==1)
		{
			$manufactures=$this->getManufactureTable()->fetchAll();
			$array['ms']=$manufactures;
		}
		$array['step']=$step;
		return new ViewModel($array);
	}

	public function getProductTable()
	{
		if(!$this->productTable)
		{
			$sm=$this->getServiceLocator();
			$this->productTable=$sm->get('Admin\Model\ProductTable');
		}
		return $this->productTable;
	}

	public function getManufactureTable()
	{
		if(!$this->manufactureTable)
		{
			$sm=$this->getServiceLocator();
			$this->manufactureTable=$sm->get('Admin\Model\ManufactureTable');
		}
		return $this->manufactureTable;
	}
}