<?php

namespace Paste\Controller;

use PhlyRestfully\ResourceController;
use Zend\Mvc\Exception\InvalidArgumentException;


class ApiController extends ResourceController{
	

	public function __construct($eventIdentifier = null){

		parent::__construct($eventIdentifier);

/*		throw new InvalidArgumentException(sprintf(
            'Invalid property name "%s"',
            "name"
        ));*/

	}
}