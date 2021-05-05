<?php

declare(strict_types=1);

namespace App\Model;

use App\Exception\StorageException;
use App\Model\AbstractModel;
use PDO;

class BlogModel extends AbstractModel
{
    public function getPosts(int $pageSize, int $pageNumber):array
    {
        $limit = $pageSize;
        $offset = ($pageNumber - 1) * $pageSize;

        $query = "
        SELECT id, title, description, created 
        FROM blog 
        ORDER BY id DESC
        LIMIT $offset, $limit
        ";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPosts():int
    {
        $query = "SELECT count(*) as count FROM blog";
        $result = $this->conn->query($query);
        $result = $result->fetch(PDO::FETCH_ASSOC);
        if($result !== false){
            return (int) $result['count'];
        } 
        exit("Nieudana próba pobrania liczby notatek. Posimy odświeżyć stronę.");
    }

    public function getPost(string $name):array
    {
        $query = "SELECT * FROM blog WHERE title = '$name'";
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}