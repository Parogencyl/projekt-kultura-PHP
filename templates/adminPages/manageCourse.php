<?php
    $error = $success = '';
    if($params['error']){
        if($params['error'] === 'notEditedCourse'){
            $error = "Kurs nie został zedytowany.";
        } else if($params['error'] === 'notEditedData'){
            $error = "Nie udało się zedytować informacji o kursie.";
        }  else if($params['error'] === 'notEditedVideo'){
            $error = "Nie udało się zedytować filmu promocyjnego kursu.";
        }  
    }

    if($params['success']){
        if($params['success'] === 'editedAll'){
            $success = "Kurs został zedytowany.";
        } else if($params['success'] === 'editedData'){
            $success = "Informacji o kursie zostały zedytowane.";
        } else if($params['success'] === 'editedVideo'){
            $success = "Film promocyjny kursu został zedytowany.";
        } 
    }

    $course = $params['course'];
?>

<section class="container mb-5 mt-5">

    <?php if($error != ''): ?>
        <div class="alert alert-danger alert-block col-12 my-3">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> <?php echo $error ?> </strong>
        </div>
    <?php endif; ?>

    <?php if($success != ''): ?>
        <div class="alert alert-success alert-block col-12 my-3">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> <?php echo $success ?> </strong>
        </div>
    <?php endif; ?>

    <h1 class="font-weight-bold text-center mb-3 text-uppercase "> Edytuj kurs </h1>

    <h4 class="text-center mb-5"> <?php echo $course['title'] ?> </h4>

    <form action="/projekt-kultura/admin.php/?page=manageCourse" method="POST" enctype="multipart/form-data">

        <div class="form-group mb-3">
            <input type="text" class="form-control" name="name" value="<?php echo $course['title'] ?>" placeholder="Nazwa kursu"
             readonly>
        </div>

        <div class="form-group">
            <input class="form-control" id="exampleFormControlTextarea1" name="duration" placeholder="Czas kursu"
                type="time" value="<?php echo $course['duration'] ?>" required>
        </div>

        <div class="input-group">
            <input class="form-control" type="text" id="inlineFormInputGroupPrice1" name="price1"
                placeholder="Cena - wariant 1" value="<?php echo $course['price1'] ?>" required>
            <div class="input-group-prepend">
                <div class="input-group-text">zł</div>
            </div>
        </div>
        <small> Grosze należy podać po znaku . (199.99) </small>

        <div class="form-group mb-0 mt-2">
            <input class="form-control" name="variant1" placeholder="Wariant 1 - każdy punkt odzielony znakiem |"
                value="<?php echo $course['variant1'] ?>">
        </div>
        <small> Wariant zawiera już Kurs szkoleniowy. </small>

        <div class="input-group mt-2">
            <input class="form-control" type="text" name="price2" placeholder="Cena - wariant 2"
                value="<?php echo $course['price2'] ?>">
            <div class="input-group-prepend">
                <div class="input-group-text">zł</div>
            </div>
        </div>
        <small> Grosze należy podać po znaku . (199.99) </small>

        <div class="form-group mb-0 mt-2">
            <input class="form-control" name="variant2" placeholder="Wariant 2 - każdy punkt odzielony znakiem |"
                value="<?php echo $course['variant2'] ?>">
        </div>
        <small> Wariant zawiera już Kurs szkoleniowy. </small>

        <div class="input-group mt-2">
            <input class="form-control" type="text" name="price3" placeholder="Cena - wariant 3"
                value="<?php echo $course['price3'] ?>">
            <div class="input-group-prepend">
                <div class="input-group-text">zł</div>
            </div>
        </div>
        <small> Grosze należy podać po znaku . (199.99) </small>

        <div class="form-group mb-0 mt-2">
            <input class="form-control" name="variant3" placeholder="Wariant 3 - każdy punkt odzielony znakiem |"
                value="<?php echo $course['variant3'] ?>">
        </div>
        <small> Wariant zawiera już Kurs szkoleniowy. </small>

        <div class="form-group mt-2">
            <textarea class="form-control" name="learn" rows="4"
                placeholder="Czego się nauczysz w kursie (każdy punkt odzielony znakiem | )"
                value="<?php echo $course['about'] ?>" required><?php echo $course['about'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="file-input1" class="font-weight-bold">Wybierz zwiastun: </label>
            <input id="file-input1" type="file" name="videoZwiastun">
        </div>

        <div class="row justify-content-center p-0 m-0">
            <a href="/projekt-kultura/admin.php/?page=coursesShop" class="btn btn-dark btn-lg mr-4"> WRÓĆ </a>
            <button type="submit" value="submit" name="submit" class="btn btn-lg btn-success mr-4"> ZMIEŃ </button>
            <button type="submit" value="delete" name="submit" class="btn btn-lg btn-danger"> USUŃ </button>
        </div>

    </form>

</section>
