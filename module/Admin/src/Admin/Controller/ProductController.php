<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
		$manufactures=$this->getManufactureTable()->fetchAll();

		return new ViewModel(array(
			'ms'=>$manufactures,
		));
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