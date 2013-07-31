<?php
namespace Paste\Model;

use Zend\Db\TableGateway\TableGateway;
use Paste\Model\PersistenceInterface;

class AlbumTable implements PersistenceInterface
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAlbum($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function save(array $data){

         $album = new Album();
         $album->exchangeArray($data);                 
         return $this->saveAlbum($album);
    }

    public function fetch($id){
        return $this->getAlbum($id);
    }

    public function saveAlbum(Album $album)
    {
        $data = array(
            'artist' => $album->artist,
            'title'  => $album->title,
        );

        $id = (int)$album->id;
        if ($id == 0) {            
            $result = $this->tableGateway->insert($data);            
            if ($result){
                $id = $this->tableGateway->getLastInsertValue();
                $album->id = $id;
            }
            else
                throw new \Exception('Error when inserting');

        } else {
            if ($this->getAlbum($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
        return $album;
    }

    public function deleteAlbum($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}