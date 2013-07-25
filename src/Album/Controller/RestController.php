<?php
namespace Album\Controller;


use Zend\Mvc\Controller\AbstractActionController;
//use Zend\Mvc\Controller\AbstractRestfulController // Use for webservice
use Zend\View\Model\ViewModel;
use Album\Model\Album;          // <-- Add this import
use Album\Form\AlbumForm;       // <-- Add this import

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