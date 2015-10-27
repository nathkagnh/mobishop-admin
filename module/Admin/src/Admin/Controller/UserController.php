<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Model\User;

class UserController extends AbstractActionController
{
	protected $userTable;

    public function indexAction()
    {
        return new ViewModel(array(
        	'users'=>$this->getUserTable()->fetchAll(),
        ));
    }

    public function createAction()
    {
        $request=$this->getRequest();
        $message=null;
        if($request->isPost())
        {
            $user=new User();
            $user->email=$request->getPost('email');
            $user->name=$request->getPost('name');
            $user->pass=$request->getPost('pass');
            $user->address=$request->getPost('address');
            $user->tel=$request->getPost('tel');
            $user->status=$request->getPost('status');
            $user->admin=$request->getPost('admin');

            $result=$this->getUserTable()->insertUser($user);
            if($result==1)
                $message='Successful!';
            else $message='Email is exits';
        }
        return new ViewModel(array(
            'message'=>$message,
        ));
    }

    public function updateAction()
    {
        $request=$this->getRequest();
        $id=$this->params()->fromRoute('id');
        $message=null;
        if($request->isPost())
        {
            $user=new User();
            $user->id=$id;
            $user->email=$request->getPost('email');
            $user->name=$request->getPost('name');
            $user->pass=$request->getPost('pass');
            $user->address=$request->getPost('address');
            $user->tel=$request->getPost('tel');
            $user->status=$request->getPost('status');
            $user->admin=$request->getPost('admin');

            $result=$this->getUserTable()->updateUser($user);

            if($result==1)
                $message='Successful!';
            else $message='Error. Please try again!';
        }
        if(isset($id))
        {
            $user=$this->getUserTable()->getUserById($id);
            if(isset($user))
            {
                return new ViewModel(array(
                    'user'=>$user,
                    'message'=>$message,
                ));
            }
        }
        $this->redirect()->toRoute('user');
    }

    public function deleteAction()
    {
        $id=$this->params()->fromRoute('id');
        $this->getUserTable()->deleteUser($id);
        $this->redirect()->toRoute('user');
    }

    public function getUserTable()
    {
    	if(!$this->userTable)
    	{
    		$sm=$this->getServiceLocator();
    		$this->userTable=$sm->get('Admin\Model\UserTable');
    	}
    	return $this->userTable;
    }
}