<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Model\Advertise;

use Zend\File\Transfer\Adapter\Http;
use Zend\Validator\File\Size;
use Zend\Validator\File\Extension;

class AdvertiseController extends AbstractActionController
{
	protected $advertiseTable;

	public function indexAction()
	{
		$advertises=$this->getAdvertiseTable()->fetchAll();
		return new ViewModel(array(
			'advertises'=>$advertises,
		));
	}

	public function createAction()
	{
		$request=$this->getRequest();
		$message=null;
		if($request->isPost())
		{
			// Get file upload
			$files=$request->getFiles()->toArray();
			$filePostName='image';
			$file=$files[$filePostName];

			// Check validate
			$httpadapter = new Http();
			$httpadapter->addValidator(
				'Size',
				true,
				array('min'=>1000),
				$filePostName
			);
			$httpadapter->addValidator(
				'Extension',
				true,
				array('png', 'jpg', 'jpeg'),
				$filePostName
			);

			// Rename file upload
			$httpadapter->addFilter(
				'Rename',
				array(
					'target'=>__UPLOAD__.'/ads/'.$file['name'],
					'randomize'=>true,
				),
				$filePostName
			);

			// Save file upload
			$newFileName=null;
			if($httpadapter->isValid())
			{
				if($httpadapter->receive($file['name']))
				{
					$fileInfo = $httpadapter->getFileInfo();
					$newFileName=$fileInfo[$filePostName]['name'];
				}
			}

			$ads=new Advertise();
			$ads->image=$newFileName;
			$ads->link=$request->getPost('link');
			$ads->date_start=$request->getPost('date_start');
			$ads->date_end=$request->getPost('date_end');
			$ads->location=$request->getPost('location');
			$ads->show=$request->getPost('show');

			$this->getAdvertiseTable()->insertAdvertise($ads);
			$message="Successful!";
		}
		return new ViewModel(array(
			'message'=>$message,
		));
	}

	public function updateAction()
	{
		$id=$this->params()->fromRoute('id');
		$request=$this->getRequest();
		$message=null;
		if($request->isPost())
		{
			// Get file upload
			$files=$request->getFiles()->toArray();
			$filePostName='image';
			$file=$files[$filePostName];

			// Check validate
			$httpadapter = new Http();
			$httpadapter->addValidator(
				'Size',
				true,
				array('min'=>1000),
				$filePostName
			);
			$httpadapter->addValidator(
				'Extension',
				true,
				array('png', 'jpg', 'jpeg'),
				$filePostName
			);

			// Rename file upload
			$httpadapter->addFilter(
				'Rename',
				array(
					'target'=>__UPLOAD__.'/ads/'.$file['name'],
					'randomize'=>true,
				),
				$filePostName
			);

			// Save file upload
			$newFileName=null;
			if($httpadapter->isValid())
			{
				if($httpadapter->receive($file['name']))
				{
					$fileInfo = $httpadapter->getFileInfo();
					$newFileName=$fileInfo[$filePostName]['name'];
				}
			}

			$adsPost=new Advertise();
			$adsPost->id=$id;
			$adsPost->image=$newFileName;
			$adsPost->link=$request->getPost('link');
			$adsPost->date_start=$request->getPost('date_start');
			$adsPost->date_end=$request->getPost('date_end');
			$adsPost->location=$request->getPost('location');
			$adsPost->show=$request->getPost('show');
			$adsPost->view_count=$request->getPost('view_count');
			$adsPost->click_count=$request->getPost('click_count');

			$result=$this->getAdvertiseTable()->updateAdvertise($adsPost);
			if($result)
				$message='Successful!';
			else
				$message='Error!! Please try again.';
		}
		$ads=$this->getAdvertiseTable()->getAdvertiseById($id);
		return new ViewModel(array(
			'ads'=>$ads,
			'message'=>$message,
		));
	}

	public function deleteAction()
	{
		$id=$this->params()->fromRoute('id');
		$this->getAdvertiseTable()->deleteAdvertise($id);
		$this->redirect()->toRoute('advertise');
	}

	public function showAction()
	{
		$id=$this->params()->fromRoute('id');
		$status=$this->params()->fromQuery('status');

		if($status=='1')
			$this->getAdvertiseTable()->changeStatus($id, false);
		else
			$this->getAdvertiseTable()->changeStatus($id, true);
		$this->redirect()->toRoute('advertise');
	}

	public function getAdvertiseTable()
	{
		if(!$this->advertiseTable)
		{
			$sm=$this->getServiceLocator();
			$this->advertiseTable=$sm->get('Admin\Model\AdvertiseTable');
		}
		return $this->advertiseTable;
	}
}