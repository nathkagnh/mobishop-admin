<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Model\User;

use Zend\Session\Container;

class AdminController extends AbstractActionController
{
    protected $userTable;

    public function indexAction()
    {
        $container=new Container('user');
        $infoUser=null;
        if(isset($container->email))
            $infoUser=array('email'=>$container->email, 'name'=>$container->name);
        return new ViewModel(array(
            'infoUser'=>$infoUser,
            ));
    }

    public function loginAction()
    {
        $request=$this->getRequest();
        $respone=array('id'=>0, 'msg'=>'');
        if($request->isPost())
        {
            $user=$request->getPost('user');
            $pass=$request->getPost('pass');

            $check=$this->getUserTable()->check($user, $pass);
            if($check['id']==1)
            {
                $container=new Container('user');
                $container->email=$user;
                $container->name=$check['name'];
            }
            else if($check['id']==2)
            {
                $respone['id']=2;
                $respone['msg']='Username not exist!!';
            }
            else
            {
                $respone['id']=3;
                $respone['msg']='Password is invalid!!';
            }
            echo json_encode($respone);
            exit;
        }
        return $this->getResponse();
    }

    public function logoutAction()
    {
        $session=new Container('user');
        $session->getManager()->getStorage()->clear();
        return $this->redirect()->toRoute('home');
    }

    public function registerAction()
    {
        return new ViewModel();
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