<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Model\Product;

class ProductController extends AbstractActionController
{
	protected $productTable;

	public function indexAction()
	{
		$products=$this->getProductTable()->fetchAll();
		return new ViewModel(array(
			'products'=>$products,
			));
	}

	public function createAction()
	{
		return new ViewModel();
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
}