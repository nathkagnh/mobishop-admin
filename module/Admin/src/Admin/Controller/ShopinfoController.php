<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController; 
use Zend\View\Model\ViewModel;

use Admin\Model\Info;

use Zend\File\Transfer\Adapter\Http;
use Zend\Validator\File\Size;
use Zend\Validator\File\Extension;

use Admin\Helper\StringHelper;

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
		$formatString=new StringHelper();
		if($request->isPost())
		{
			$newFileName=null;
				$files =  $request->getFiles()->toArray();
				$httpadapter = new Http(); 
				$filesize  = new Size(array('min' => 1000 )); //1KB  
				$extension = new Extension(array('extension' => array('png', 'jpg', 'jpeg')));
				$httpadapter->setValidators(
					array($filesize, $extension), 
					$files['logo']['name']
				);
				if($httpadapter->isValid())
				{
					$httpadapter->setDestination(__UPLOAD__.'\page');
					if($httpadapter->receive($files['logo']['name']))
					{
						$newFileName = $httpadapter->getFileName(); 
					}
				}

			$data=new Info();
			$data->name=$request->getPost('name');
			$data->logo=$newFileName;
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