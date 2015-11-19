<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AjaxController extends AbstractActionController
{
	protected $manufactureTable;

	public function createProductStep1Action()
	{ 
	    $manufactures=$this->getManufactureTable()->fetchAll();
		$view=new ViewModel(array(
			'ms'=>$manufactures,
			));
		$view->setTemplate('admin/ajax/createproductstep1');
	    $view->setTerminal(true);
	    return $view;
	}

	public function createProductStep2Action()
	{
		$view=new ViewModel();
		$view->setTemplate('admin/ajax/createproductstep2');
	    $view->setTerminal(true);
	    return $view;
	}

	public function createProductStep3Action()
	{
		$view=new ViewModel();
		$view->setTemplate('admin/ajax/createproductstep3');
	    $view->setTerminal(true);
	    return $view;
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