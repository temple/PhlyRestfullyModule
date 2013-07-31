<?php
namespace Paste;

use PhlyRestfully\Exception\CreationException;
use PhlyRestfully\Exception\DomainException;
use PhlyRestfully\Exception\PatchException;
use PhlyRestfully\ResourceEvent;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Paste\Model\AlbumTable;
use Paste\Model\PersistenceInterface;

class PasteResourceListener extends AbstractListenerAggregate
{
    protected $persistence;

    public function __construct(PersistenceInterface $persistence)
    {        
        $this->persistence = $persistence;
    }

    public function attach(EventManagerInterface $events)
    {     
        $this->listeners[] = $events->attach('create', array($this, 'onCreate'));
        $this->listeners[] = $events->attach('fetch', array($this, 'onFetch'));
        $this->listeners[] = $events->attach('fetchAll', array($this, 'onFetchAll'));
        $this->listeners[] = $events->attach('patch', array($this, 'onPatch'));
        $this->listeners[] = $events->attach('put', array($this, 'onPatch'));
    }

    public function onCreate(ResourceEvent $e)
    {

        $data  = $e->getParam('data');
        $data = (array)$data;
        $paste = $this->persistence->save($data);
        if (!$paste) {
            throw new CreationException();
        }
        return $paste;
    }

    public function onPatch(ResourceEvent $e)
    {

        $data = $e->getParam('data');
        $id = $e->getParam('id');

        $paste = $this->persistence->fetch($id);

        if (!$paste) {
                throw new PatchException();
        }
        else{               
            $paste->exchangeArray($data);
            $paste = $this->persistence->saveAlbum($paste);
        }
        return $paste;
    }

    public function onFetch(ResourceEvent $e)
    {
        $id = $e->getParam('id');
        $paste = $this->persistence->fetch($id);
        if (!$paste) {
            throw new DomainException('Paste not found', 404);
        }
        return $paste;
    }

    public function onFetchAll(ResourceEvent $e)
    {
        return $this->persistence->fetchAll();
    }
}
