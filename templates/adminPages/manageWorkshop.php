<?php
    $workshop = $params['workshop'];
    $error = $success = '';
    if($params['error']){
        if($params['error'] === 'update'){
            $error = "Nie udało się zaktualizować danych.";
        } else if($params['error'] === 'upload'){
            $error = "Nie udało się zaktualizować obrazów.";
        } else if($params['error'] === 'delete'){
            $error = "Nie udało się usunąć wybranego warsztatu.";
        }
    }

    if($params['success']){
        if($params['success'] === 'updated'){
            $success = "Dane został zaktualizowane.";
        } else if($params['success'] === 'allUpdated'){
            $success = "Dane oraz obrazy zostały zaktualizowane.";
        } else if($params['success'] === 'uploaded'){
            $success = "Obrazy zostały zaktualizowane.";
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

    <h1 class="font-weight-bold text-center mb-3 text-uppercase"> Edytuj warsztat </h1>

    <h4 class="text-center mb-5"> <?php echo $workshop['name'] ?> </h4>

    <form action="/projekt-kultura/admin.php/?page=manageWorkshop&name=<?php echo $workshop['name'] ?>" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $workshop['id'] ?>">

        <div class="form-group mb-3">
            <input type="text" class="form-control" name="name" value="<?php echo $workshop['name'] ?>"
                placeholder="Nazwa warsztatu" readonly>
        </div>

        <div class="form-group">
            <textarea class="form-control" name="description" rows="4" placeholder="Główny tekst" value="<?php echo $workshop['description'] ?>"
                required><?php echo $workshop['description'] ?></textarea>
        </div>

        <div class="form-check mb-4">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="forSale" <?php echo $workshop['for_sale'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="exampleCheck1">Czy sprzedawać</label>
        </div>

        <div class="form-group mb-3">
            <input type="text" class="form-control" name="price" value="<?php echo $workshop['price'] ?>"
                placeholder="Cena warsztatu">
        </div>

        <div class="form-group">
            <label for="file-input1" class="font-weight-bold">Wybierz zdjęcie 1: </label>
            <input id="file-input1" type="file" name="file1">
        </div>

        <div class="form-group">
            <label for="file-input2" class="font-weight-bold">Wybierz zdjęcie 2: </label>
            <input id="file-input2" type="file" name="file2">
        </div>

        <div class="form-group">
            <label for="file-input3" class="font-weight-bold">Wybierz zdjęcie 3: </label>
            <input id="file-input3" type="file" name="file3">
        </div>

        <div class="form-group">
            <label for="file-input4" class="font-weight-bold">Wybierz zdjęcie 4: </label>
            <input id="file-input4" type="file" name="file4">
        </div>

        <div class="row justify-content-center">
            <a href="/projekt-kultura/admin.php/?page=workshops" class="btn btn-dark btn-lg mr-4"> WARSZTATY </a>
            <button type="submit" value="submit" name="submit" class="btn btn-lg btn-success mr-4"> ZMIEŃ </button>
            <a href="/projekt-kultura/admin.php/?page=manageWorkshop&action=delete&
            id=<?php echo $workshop['id'] ?>&name=<?php echo $workshop['name'] ?>" 
            class="btn btn-lg btn-danger"> USUŃ </a>
        </div>

    </form>

</section>