<?php
    $index = 0;

    $error = $success = '';
    if($params['error']){
        if($params['error'] === 'notAddedVideo'){
            $error = "Nie udało się dodać filmu do kursu.";
        } else if($params['error'] === 'notAddedCourse'){
            $error = "Nie udało się dodać kursu.";
        }  
    }

    if($params['success']){
        if($params['success'] === 'addedCourse'){
            $success = "Kurs został dodany wraz z filmem.";
        } else if($params['success'] === 'addedCourseData'){
            $success = "Opis kursu został dodany.";
        } 
    }
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

    <h1 class="font-weight-bold text-center mb-3 text-uppercase"> Dodaj kurs </h1>

    <form action="/projekt-kultura/admin.php/?page=addCourse" method="POST" enctype="multipart/form-data">

        <div class="form-group mb-3">
            <input type="text" class="form-control" name="name" placeholder="Nazwa kursu" required>
        </div>

        <div class="form-group">
            <input class="form-control" name="duration" placeholder="Czas kursu" type="time" required>
        </div>

        <div class="input-group">
            <input class="form-control" type="text" name="price1" placeholder="Cena - wariant I" required>
            <div class="input-group-prepend">
                <div class="input-group-text">zł</div>
            </div>
        </div>
        <small> Grosze należy podać po znaku . (199.99) </small>

        <div class="form-group mb-0 mt-2">
            <input class="form-control" name="variant1" placeholder="Wariant 1 - każdy punkt odzielony znakiem |">
        </div>
        <small> Wariant zawiera już Kurs szkoleniowy. </small>

        <div class="input-group mt-2">
            <input class="form-control" type="text" name="price2" placeholder="Cena - wariant II">
            <div class="input-group-prepend">
                <div class="input-group-text">zł</div>
            </div>
        </div>
        <small> Grosze należy podać po znaku . (199.99) </small>

        <div class="form-group mb-0 mt-2">
            <input class="form-control" name="variant2" placeholder="Wariant 2 - każdy punkt odzielony znakiem |">
        </div>
        <small> Wariant zawiera już Kurs szkoleniowy. </small>

        <div class="input-group mt-2">
            <input class="form-control" type="text" name="price3" placeholder="Cena - wariant III">
            <div class="input-group-prepend">
                <div class="input-group-text">zł</div>
            </div>
        </div>
        <small> Grosze należy podać po znaku . (199.99) </small>

        <div class="form-group mb-0 mt-2">
            <input class="form-control" name="variant3" placeholder="Wariant 3 - każdy punkt odzielony znakiem |">
        </div>
        <small> Wariant zawiera już Kurs szkoleniowy. </small>

        <div class="form-group mt-2">
            <textarea class="form-control" name="learn" rows="4"
                placeholder="Czego się nauczysz w kursie (każdy punkt odzielony znakiem | )"
                required></textarea>
        </div>

        <div class="form-group">
            <label for="file-input2" class="font-weight-bold">Wybierz zwiastun: </label>
            <input id="file-input2" type="file" name="video" required>
        </div>

        <div class="row justify-content-center">
            <a href="/projekt-kultura/admin.php/?page=coursesShop" class="btn btn-dark btn-lg mr-4"> WRÓĆ </a>
            <button type="submit" class="btn btn-lg btn-success mr-4"> DODAJ </button>
        </div>

    </form>

</section>