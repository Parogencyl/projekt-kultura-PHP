<?php
    $error = $success = '';
    if($params['error']){
        if($params['error'] === 'add'){
            $error = "Nie udało się utworzyć nowego posta.";
        }else if($params['success'] === 'upload'){
            $success = "Post został dodany, lecz bez zdjęcia.";
        }
    }

    if($params['success']){
        if($params['success'] === 'added'){
            $success = "Post został dodany.";
        }
    }
?>
<section class="container py-5">
    
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

    <h1 class="font-weight-bold text-center text-uppercase mb-3"> Dodaj post </h1>

    <form action="/projekt-kultura/admin.php/?page=addPost" method="POST" enctype="multipart/form-data">

        <div class="form-group mb-3">
            <input type="text" class="form-control" name="title" placeholder="Tytuł postu" required>
        </div>

        <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"
                placeholder="Tekst skrócony - tekst na stronę główną" required></textarea>
        </div>

        <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea2" name="text" rows="5"
                placeholder="Tekst główny - tekst na stronę postu" required></textarea>
        </div>

        <div class="form-group">
            <label for="file-input1" class="font-weight-bold">Wybierz zdjęcie: </label>
            <input id="file-input1" type="file" name="image" required>
        </div>

        <div class="row justify-content-center">
            <a href="/projekt-kultura/admin.php/?page=main" class="btn btn-dark btn-lg mr-4"> STRONA GŁÓWNA </a>
            <button type="submit" class="btn btn-lg btn-success"> DODAJ </button>
        </div>

    </form>

</section>
