<?php

namespace Paste\Model;

interface PersistenceInterface
{
    public function save(array $data);
    public function fetch($id);
    public function fetchAll();
}
