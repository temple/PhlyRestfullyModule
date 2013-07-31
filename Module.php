<?php
namespace Paste;

// Add these import statements:
use Paste\Model\Album;
use Paste\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Paste\PasteResourceListener;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

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

    public function getConfig()
    {        
        return include __DIR__ . '/config/module.config.php';
    }
    
    // Add this method:
    public function getServiceConfig()
    {        

    	$result= array(
    			'factories' => array(
    					'Paste\Model\AlbumTable' =>  function($sm) {
    						$tableGateway = $sm->get('AlbumTableGateway');
    						$table = new AlbumTable($tableGateway);
    						return $table;
    					},
    					'AlbumTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Album());
    						return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
    					},
                        'Paste\Model\PersistenceInterface' => function($sm){
                            $interface = $sm->get('Paste\Model\AlbumTable');
                            return $interface;                            
                        },
                        'Paste\PasteResourceListener' => function($sm){                            
                            $persistence = $sm->get('Paste\Model\PersistenceInterface');                           
                            return new PasteResourceListener($persistence);
                        }
    			),
    	);        
        return $result;
    }
}