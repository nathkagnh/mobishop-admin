<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AjaxController extends AbstractActionController
{
	protected $manufactureTable;

	public function createproductstep1Action()
	{
		$manufactures=$this->getManufactureTable()->fetchAll();

		return new ViewModel(array(
			'ms'=>$manufactures,
			'id'=>'12121',
		));
	}

	public function createproductstep2Action()
	{
		$id=$this->params()->fromRoute('id');
		return new ViewModel(array(
			'id'=>$id,
		));
	}

	public function createproductstep3Action()
	{
		$id=$this->params()->fromRoute('id');
		return new ViewModel(array(
			'id'=>$id,
		));
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