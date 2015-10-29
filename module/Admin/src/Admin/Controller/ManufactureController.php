<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ManufactureController extends AbstractActionController
{
	protected $manufactureTable;

	public function indexAction()
	{
		return new ViewModel();
	}

	public function getManufactureTable()
	{
		if(!$manufactureTable)
		{
			$sm=$this->getServiceLocator();
			$this->manufactureTable=$sm->get('Admin\Model\ManufactureTable');
		}
		return $this->manufactureTable;
	}
}