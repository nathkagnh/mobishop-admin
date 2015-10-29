<?php
namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Admin\Model\User;
use Admin\Model\UserTable;

use Admin\Model\Info;
use Admin\Model\InfoTable;

use Admin\Model\Advertise;
use Admin\Model\AdvertiseTable;

use Admin\Model\Manufacture;
use Admin\Model\ManufactureTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                //User
                'Admin\Model\UserTable' =>  function($sm) {
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },

                //Info
                'Admin\Model\InfoTable' =>  function($sm) {
                    $tableGateway = $sm->get('InfoTableGateway');
                    $table = new InfoTable($tableGateway);
                    return $table;
                },
                'InfoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Info());
                    return new TableGateway('shopinfo', $dbAdapter, null, $resultSetPrototype);
                },

                //Advertise
                'Admin\Model\AdvertiseTable' =>  function($sm) {
                    $tableGateway = $sm->get('AdvertiseTableGateway');
                    $table = new AdvertiseTable($tableGateway);
                    return $table;
                },
                'AdvertiseTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Advertise());
                    return new TableGateway('advertise', $dbAdapter, null, $resultSetPrototype);
                },

                //Manufacture
                'Admin\Model\ManufactureTable' =>  function($sm) {
                    $tableGateway = $sm->get('ManufactureTableGateway');
                    $table = new ManufactureTable($tableGateway);
                    return $table;
                },
                'ManufactureTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Manufacture());
                    return new TableGateway('manufacture', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}