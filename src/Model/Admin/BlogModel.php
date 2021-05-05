<?php

declare(strict_types=1);

namespace App\Model\Admin;

use App\Model\BlogModel as ModelBlogModel;
use PDO;

class BlogModel extends ModelBlogModel
{
    public function updatePost(array $data):void
    {
        $id = $data['id'];
        $title = $data['title'];
        $description = $data['description'];
        $text = $data['text'];

        $query = "
            UPDATE blog 
            SET description = '$description', text = '$text' 
            WHERE id = '$id'
        ";
        
        if($this->conn->exec($query)){
            if($this->uploadFile($_FILES, 'posts', $title)){
                header("Location: /projekt-kultura/admin.php/?page=managePost&name=$title&success=allUpdated");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=managePost&name=$title&error=upload&success=updated");
            exit;
        }else{
            if($this->uploadFile($_FILES, 'posts', $title)){
                header("Location: /projekt-kultura/admin.php/?page=managePost&name=$title&success=uploaded");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=managePost&name=$title&error=update");
            exit;
        }
    }

    public function addPost(array $data):void
    {
        $title = $data['title'];
        $description = $data['description'];
        $text = $data['text'];

        $query = "
            INSERT INTO blog (title, description, text) 
            VALUES ('$title', '$description', '$text')
        ";
            
        if($this->conn->exec($query)){
            if($this->uploadFile($_FILES, 'posts', $title)){
                header("Location: /projekt-kultura/admin.php/?page=addPost&name=$title&success=addded");
                exit;
            } else {
                header("Location: /projekt-kultura/admin.php/?page=addPost&name=$title&error=upload");
                exit;
            }
        }else{
            header("Location: /projekt-kultura/admin.php/?page=addPost&name=$title&error=add");
            exit;
        }
    }

    public function addBaner(int $number):void
    {   
        $fileName = "baner$number";
        if($this->uploadFile($_FILES, 'baners', $fileName)){
            header("Location: /projekt-kultura/admin.php/?page=main&success=added");
                exit;
        } else {
            header("Location: /projekt-kultura/admin.php/?page=main&error=add");
            exit;
        }
    }

    public function deleteBaner(int $number):void
    {   
        $fileName = "baner$number";
        if(unlink("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/$fileName.jpg")){
            header("Location: /projekt-kultura/admin.php/?page=main&success=deleted");
                exit;
        } else {
            header("Location: /projekt-kultura/admin.php/?page=main&error=delete");
            exit;
        }
    }

}