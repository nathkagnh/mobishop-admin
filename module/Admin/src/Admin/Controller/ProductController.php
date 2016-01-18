<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Model\Product;

use Zend\File\Transfer\Adapter\Http;
use Zend\Validator\File\Size;
use Zend\Validator\File\Extension;

use Zend\Filter\File\Rename;

class ProductController extends AbstractActionController
{
	protected $productTable;
	protected $manufactureTable;

	public function indexAction()
	{
		$products=$this->getProductTable()->fetchAll();
		return new ViewModel(array(
			'products'=>$products
			));
	}

	public function createAction()
	{
		$manufactures=$this->getManufactureTable()->fetchAll();
		return new ViewModel(array(
			'manufactures'=>$manufactures
			));
	}

	public function postAction()
	{
		$request = $this->getRequest();
		if($request->isPost())
		{
			$product = new Product();
			$product->name = $request->getPost('name');
			$product->price = $request->getPost('price');
			$product->manufacture = $request->getPost('manufacture');
			$product->inventory_number = $request->getPost('inventory_number');
			$product->date = $request->getPost('date');
			$product->show = $request->getPost('show');

			// Get images
			$temp = array();
			$imgTotal = intval($request->getPost('imgTotal'));
			$httpadapter = new Http();
			$httpadapter->addValidator(
				'Size',
				true,
				array('min' => 1000)
				);
			$httpadapter->addValidator(
				'Extension',
				true,
				array('png', 'jpg', 'jpeg')
				);
			for($i = 0; $i < $imgTotal; $i++)
			{
				$fileName = 'image_' . $i;
				$image = $request->getFiles($fileName);
				$httpadapter->addFilter(
					'Rename',
					array(
						'target' => __UPLOAD__ . '/products/' . $product->name . '-' . $image['name'],
						'randomize' => true
						)
					);
				if($httpadapter->isValid())
				{
					if($httpadapter->receive($image['name']))
					{
						$temp[] = $httpadapter->getFileInfo()[$fileName]['name'];
					}
				}
			}

			$product->images = implode(';', $temp);
			$product->display = $request->getPost('display');
			$product->os = $request->getPost('os');
			$product->cpu = $request->getPost('cpu');
			$product->camera = $request->getPost('camera');
			$product->internal_memory = $request->getPost('internal_memory');
			$product->ram = $request->getPost('ram');
			$product->battery = $request->getPost('battery');
			$product->more = $request->getPost('more');

			// Insert product
			if($this->getProductTable()->insertProduct($product))
				echo json_encode('successful');
			else echo json_encode('Insert error');
			exit;
		}
	}

	public function getProductTable()
	{
		if(!$this->productTable)
		{
			$sm=$this->getServiceLocator();
			$this->productTable=$sm->get('Admin\Model\ProductTable');
		}
		return $this->productTable;
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