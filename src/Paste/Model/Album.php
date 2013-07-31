<?php
namespace Paste\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

function toArray(Album $album){
    return get_object_vars($album);
}

class Album implements InputFilterAwareInterface
{
    public $id;
    public $artist;
    public $title;
    protected $inputFilter;                       // <-- Add this variable
    
   /**
     * Tells whenever a the attributes present in $data mean a partial or a full update
     *
     * @param  array $data The array of data to set
     * @return bool  Tells if update is just partial (not full)
     */   
    protected function partialUpdate¿($data){
        $props = toArray($this);
        $unchanged = array_diff_key($props, $data);      
        return (0<count($unchanged))&&!empty($data['id']);
    }

    public function exchangeArray($data)
    {
        if (is_object($data) && !is_array($data))
            $data=(array)$data;
        $part = $this->partialUpdate¿($data);

        $this->id     = (isset($data['id'])) ? $data['id'] : ($part?$this->id:null);
        $this->artist = (isset($data['artist'])) ? $data['artist'] : ($part?$this->artist:null);
        $this->title  = (isset($data['title'])) ? $data['title'] : ($part?$this->title:null);
    }
    
    // Add the following method:
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
    
    // Add content to this method:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
    	throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
    	if (!$this->inputFilter) {
    		$inputFilter = new InputFilter();
    		$factory     = new InputFactory();
    
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'id',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'Int'),
    				),
    		)));
    
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'artist',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'StringLength',
    								'options' => array(
    										'encoding' => 'UTF-8',
    										'min'      => 1,
    										'max'      => 100,
    								),
    						),
    				),
    		)));
    
    		$inputFilter->add($factory->createInput(array(
    				'name'     => 'title',
    				'required' => true,
    				'filters'  => array(
    						array('name' => 'StripTags'),
    						array('name' => 'StringTrim'),
    				),
    				'validators' => array(
    						array(
    								'name'    => 'StringLength',
    								'options' => array(
    										'encoding' => 'UTF-8',
    										'min'      => 1,
    										'max'      => 100,
    								),
    						),
    				),
    		)));
    
    		$this->inputFilter = $inputFilter;
    	}
    
    	return $this->inputFilter;
    }
}