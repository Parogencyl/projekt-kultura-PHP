<?php

declare(strict_types=1);

namespace App\Model\Admin;

use App\Model\CourseModel as ModelCourseModel;
use PDO;

class CourseModel extends ModelCourseModel
{
    public function uploadAdvertisement():void 
    {
        if($this->uploadVideo($_FILES, '', 'szkoleniaReklama', true)){
            header("Location: /projekt-kultura/admin.php/?page=coursesShop&success=uploadedAdvertisement");
            exit;
        }
        header("Location: /projekt-kultura/admin.php/?page=coursesShop&error=uploadAdvertisement");
        exit;
    } 

    public function deleteAdvertisement():void
    {
        if(unlink("C:/xampp/htdocs/projekt-kultura/public/graphics/szkoleniaReklama.mp4")){
            header("Location: /projekt-kultura/admin.php/?page=coursesShop&success=deletedAdvertisement");
            exit;
        }
        header("Location: /projekt-kultura/admin.php/?page=coursesShop&error=deleteAdvertisement");
        exit;
    }

    public function addCourse(array $data):void
    {
        $name = $data['name'];
        $duration = $data['duration'];
        $price1 = $data['price1'];
        $variant1 = $data['variant1'];
        $price2 = $data['price2'];
        $variant2 = $data['variant2'];
        $price3 = $data['price3'];
        $variant3 = $data['variant3'];
        $learn = $data['learn'];

        $query = "
            INSERT INTO courses
            (title, duration, price1, variant1, price2, variant2, price3, variant3, about)
            VALUES ('$name', '$duration', '$price1', '$variant1', '$price2', '$variant2', '$price3', '$variant3', '$learn') 
        ";

        if($this->conn->exec($query)){
            if($this->uploadVideo($_FILES, 'courses', $name, true)){
                header("Location: /projekt-kultura/admin.php/?page=addCourse&success=addedCourse");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=addCourse&error=notAddedVideo&success=addedCourseData");
            exit;
        } else {
            header("Location: /projekt-kultura/admin.php/?page=addCourse&error=notAddedCourse");
            exit;
        }
    }

    public function getCourse(string $name):array
    {
        $query = "SELECT * FROM courses WHERE title = '$name'";
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function editCourse(array $data):void
    {
        $name = $data['name'];
        $duration = $data['duration'];
        $price1 = $data['price1'];
        $variant1 = $data['variant1'];
        $price2 = $data['price2'];
        $variant2 = $data['variant2'];
        $price3 = $data['price3'];
        $variant3 = $data['variant3'];
        $learn = $data['learn'];

        $query = "
            UPDATE courses SET
            duration = '$duration', price1 = '$price1', variant1 = '$variant1', price2 = '$price2',
            variant2 = '$variant2', price3 = '$price3', variant3 = '$variant3', about = '$learn'
            WHERE title = '$name'
        ";

        if($this->conn->exec($query)){
            if($this->uploadVideo($_FILES, 'courses', $name, true)){
                header("Location: /projekt-kultura/admin.php/?page=manageCourse&name=$name&success=editedAll");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=manageCourse&name=$name&error=notEditedVideo&success=editedData");
            exit;
        } else {
            if($this->uploadVideo($_FILES, 'courses', $name, true)){
                header("Location: /projekt-kultura/admin.php/?page=manageCourse&name=$name&error=notEditedData&success=editedVideo");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=manageCourse&name=$name&error=notEditedCourse");
            exit; 
        }
    }

    public function deleteCourse(string $name):void
    {
        $query = "DELETE FROM courses WHERE title = '$name' ";

        if($this->conn->exec($query)){
            if(unlink("C:/xampp/htdocs/projekt-kultura/public/graphics/courses/$name.mp4")){
                header("Location: /projekt-kultura/admin.php/?page=coursesShop&success=deletedCourse");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=coursesShop&error=notDeletedVideo&success=deletedData");
            exit;
        } else {
            header("Location: /projekt-kultura/admin.php/?page=coursesShop&error=notDeletedCourse");
            exit;
        }
    }

}