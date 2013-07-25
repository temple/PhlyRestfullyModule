<?php
namespace Orkmodule\Controller;


use Zend\Mvc\Controller\AbstractActionController;
//use Zend\Mvc\Controller\AbstractRestfulController // Use for webservice
use Zend\View\Model\ViewModel;
use Orkmodule\Model\Orkmodule;          // <-- Add this import
use Orkmodule\Form\OrkmoduleForm;       // <-- Add this import

class RestController extends AbstractActionController{
	/**
 * [indexAction description]
 *
 * @return Zend\View\Model\ViewModel Zend View Model
 */
public function indexAction()
{
    
    // return array ('view' => array(1, 2, 3))
}


}