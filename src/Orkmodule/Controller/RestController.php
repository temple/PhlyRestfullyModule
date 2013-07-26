<?php
namespace Orkmodule\Controller;


use Zend\Mvc\Controller\AbstractActionController;
//use Zend\Mvc\Controller\AbstractRestfulController // Use for webservice
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Orkmodule\Model\Orkmodule;          // <-- Add this import
use Orkmodule\Form\OrkmoduleForm;       // <-- Add this import

class Object{
	public $array=array();
	private $priv_array;

	public function __construct($array){		
		$this->array= $array; 		
		$this->priv_array = $this->array;
	}
}

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

public function getAction(){
	return $this->readAction();
}

public function readAction(){
	$id = $this->params()->fromRoute('id', 0);
	$queryParams = $this->getRequest()->getQuery();
	return new JsonModel(array('READ' => 'response','id'=>(string)$id,'data'=>$queryParams,'success'=>true));
}

public function postAction(){
	return $this->createAction();
}

public function createAction(){
	$postParams = $this->getRequest()->getPost();
	return new JsonModel(array('CREATE'=>'response','data'=>$postParams));	
}

public function deleteAction(){
	$postParams = $this->getRequest()->getPost();
	$queryParams = $this->getRequest()->getQuery();
	$id = $this->params()->fromRoute('id', 0);
	return new JsonModel(array('DELETE'=>'response','id'=>(string)$id,'query'=>$queryParams,'data'=>$postParams));
}

public function putAction(){
	return $this->updateAction();
}

public function updateAction(){
	$id = $this->params()->fromRoute('id', 0);
	$rawContent = $this->getRequest()->getContent();
	parse_str($rawContent,$content);
	return new JsonModel(array('UPDATE'=>'response','id'=>(string)$id,'data'=>$content));
}


}