<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\AbstractModel;
use PDO;
use Throwable;
use App\Exception\StorageException;

class WorkshopModel extends AbstractModel
{
    public function getWorkshops():array
    {
        $query = "SELECT id, name FROM workshops ORDER BY id DESC";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWorkshop(string $name):array
    {
        $query = "SELECT * FROM workshops WHERE name ='$name'";
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}