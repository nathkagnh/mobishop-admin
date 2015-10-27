<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController; 
use Zend\View\Model\ViewModel;

use Admin\Model\Info;

class ShopinfoController extends AbstractActionController
{
	protected $infoTable;

	public function indexAction()
	{
		$info=$this->getInfoTable()->getInfo();
		return new ViewModel(array(
			'info'=>$info,
		));
	}

	public function updateAction()
	{
		$request=$this->getRequest();
		if($request->isPost())
		{
			$data=new Info();
			$data->name=$request->getPost('name');
			$data->logo=$request->getPost('logo');
			$data->address=$request->getPost('address');
			$data->tel=$request->getPost('tel');
			$data->introduce=$request->getPost('introduce');
			$data->image=$request->getPost('image');

			$this->getInfoTable()->updateInfo($data);
		}
		$this->redirect()->toRoute('shopinfo');
	}

	public function getInfoTable()
	{
		if(!$this->infoTable)
		{
			$sm=$this->getServiceLocator();
			$this->infoTable=$sm->get('Admin\Model\InfoTable');
		}
		return $this->infoTable;
	}
}