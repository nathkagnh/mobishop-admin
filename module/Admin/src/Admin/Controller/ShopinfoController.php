<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController; 
use Zend\View\Model\ViewModel;

use Admin\Model\Info;

use Zend\File\Transfer\Adapter\Http;
use Zend\Validator\File\Size;
use Zend\Validator\File\Extension;

use Zend\Filter\File\Rename;

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
			// Get file upload
			$files=$request->getFiles()->toArray();
			$logo=$files['logo'];

			// Check validate
			$httpadapter = new Http();
			$httpadapter->addValidator(
				'Size',
				true,
				array('min'=>1000)
			);
			$httpadapter->addValidator(
				'Extension',
				true,
				array('png', 'jpg', 'jpeg')
			);

			// Rename file upload
			$httpadapter->addFilter(
				'Rename',
				array(
					'target'=>__UPLOAD__.'/page/'.$logo['name'],
					'randomize'=>true
				)
			);

			// Save file upload
			$newFileName=null;
			if($httpadapter->isValid())
			{
				if($httpadapter->receive($logo['name']))
				{
					$fileInfo = $httpadapter->getFileInfo();
					$newFileName=$fileInfo['logo']['name'];
				}
			}

			$data=new Info();
			$data->name=$request->getPost('name');
			if(isset($newFileName))
				$data->logo='/upload/page/'.$newFileName;
			else $data->logo=null;
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