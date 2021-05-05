<?php
    $error = $success = '';
    if($params['error']){
        if($params['error'] === 'add'){
            $error = "Nie udało się dodać zespołu.";
        } 
    }

    if($params['success']){
        if($params['success'] === 'added'){
            $success = "Zespół został dodany bez obrazów.";
        } else if($params['success'] === 'allAdded'){
            $success = "Zespół oraz jego obrazy zostały dodane.";
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

    <h1 class="font-weight-bold text-center mb-3 text-uppercase"> Dodaj zespół </h1>

    <form action="/projekt-kultura/admin.php/?page=addTeam" method="POST" enctype="multipart/form-data">

        <div class="form-group mb-3">
            <input type="text" class="form-control" name="name" placeholder="Nazwa zespolu"
                required>
        </div>

        <div class="form-group">
            <textarea class="form-control" name="description" rows="4" placeholder="Główny tekst"
                required></textarea>
        </div>

        <div class="form-group">
            <label for="file-input1" class="font-weight-bold">Wybierz zdjęcie 1: </label>
            <input id="file-input1" type="file" name="file1" required>
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
            <a href="/projekt-kultura/admin.php/?page=teams" class="btn btn-dark btn-lg mr-4"> ZESPOŁY </a>
            <button type="submit" class="btn btn-lg btn-success mr-4"> DODAJ </button>
        </div>

    </form>

</section>