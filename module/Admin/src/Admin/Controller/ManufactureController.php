<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Model\Manufacture;

class ManufactureController extends AbstractActionController
{
	protected $manufactureTable;

	public function indexAction()
	{
		$ms=$this->getManufactureTable()->fetchAll();
		return new ViewModel(array(
			'ms'=>$ms,
		));
	}

	public function createAction()
	{
		$message=null;
		$request=$this->getRequest();
		if($request->isPost())
		{
			$m=new Manufacture();
			$m->name=$request->getPost('name');
			$m->address=$request->getPost('address');
			$m->tel=$request->getPost('tel');

			if(!$this->getManufactureTable()->getManufactureByName($request->getPost('name')))
			{
				$this->getManufactureTable()->insertManufacture($m);
				$message='Successful!';
			}
			else $message='Manufacture is exits. Please try again with other name.';
		}
		return new ViewModel(array(
			'message'=>$message,
		));
	}

	public function updateAction()
	{
		$id=(int)$this->params()->fromRoute('id');
		$request=$this->getRequest();
		$message=null;
		if($request->isPost())
		{
			$m=new Manufacture();
			$m->id=$id;
			$m->name=$request->getPost('name');
			$m->address=$request->getPost('address');
			$m->tel=$request->getPost('tel');

			$result=$this->getManufactureTable()->updateManufacture($m);

			if($result)
				$message='Successful!';
			else
				$message='Manufacture is not exits.';
		}
		$m=$this->getManufactureTable()->getManufacture($id);
		return new ViewModel(array(
			'm'=>$m,
			'message'=>$message,
		));
	}

	public function deleteAction()
	{
		$id=(int)$this->params()->fromRoute('id');
		$this->getManufactureTable()->deleteManufacture($id);
		$this->redirect()->toRoute('manufacture');
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