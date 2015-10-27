<?php
namespace Admin;

return array(
	'controllers'=>array(
		'invokables'=>array(
			'Admin\Controller\Admin'=>'Admin\Controller\AdminController',
			'Admin\Controller\User'=>'Admin\Controller\UserController',
			'Admin\Controller\Shopinfo'=>'Admin\Controller\ShopinfoController',
		),
	),
	'router'=>array(
		'routes'=>array(
			'home'=>array(
				'type'=>'Literal',
				'options'=>array(
					'route'=>'/',
					'defaults'=>array(
						'controller'=>'Admin\Controller\Admin',
						'action'=>'index',
					),
				),
			),
			'user'=>array(
				'type'=>'Segment',
				'options'=>array(
					'route'=>'/user[/:action[/id=:id]][/page=:page]',
					'constraints'=>array(
						'action'=>'[a-zA-Z0-9_-]*',
						'page'=>'[0-9]+',
						'id'=>'[a-zA-Z0-9_-]*',
					),
					'defaults'=>array(
						'controller'=>'Admin\Controller\User',
						'action'=>'index',
					),
				),
			),
			'shopinfo'=>array(
				'type'=>'Segment',
				'options'=>array(
					'route'=>'/shop-info[/:action]',
					'constraints'=>array(
						'action'=>'[a-zA-Z0-9_-]*',
					),
					'defaults'=>array(
						'controller'=>'Admin\Controller\Shopinfo',
						'action'=>'index',
					),
				),
			),
		),
	),
	'view_manager'=>array(
		'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'admin/admin/index' => __DIR__ . '/../view/admin/admin/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
		'template_path_stack'=>array(
			__DIR__ . '/../view',
		),
	),
);