<?php
    $post = $params['post'];
    $error = $success = '';
    if($params['error']){
        if($params['error'] === 'update'){
            $error = "Nie udało się zaktualizować danych.";
        } else if($params['error'] === 'upload'){
            $error = "Nie udało się wgrać zdjęcia.";
        } 
    }

    if($params['success']){
        if($params['success'] === 'updated'){
            $success = "Dane został zaktualizowane.";
        }else if($params['success'] === 'uploaded'){
            $success = "Obraz został dodany.";
        } else if($params['success'] === 'allUpdated'){
            $success = "Dane oraz obraz zostały zaktualizowane.";
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

    <h1 class="font-weight-bold text-center text-uppercase mb-3"> Edytuj post </h1>

    <form action="/projekt-kultura/admin.php/?page=managePost&name=<?php echo $post['title'] ?>" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $post['id'] ?>">

        <div class="form-group mb-3">
            <input type="text" class="form-control" name="title"
                value="<?php echo $post['title'] ?>" placeholder="Tytuł postu" readonly>
        </div>

        <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"
                placeholder="Tekst skrócony - tekst na stronę główną" value="<?php echo $post['description'] ?>"
                required><?php echo $post['description'] ?></textarea>
        </div>

        <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea2" name="text" rows="5"
                placeholder="Tekst główny - tekst na stronę postu" value="<?php echo $post['text'] ?>"
                required><?php echo $post['text'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="file-input1" class="font-weight-bold">Wybierz zdjęcie: </label>
            <input id="file-input1" type="file" name="image">
        </div>

        <div class="row justify-content-center">
            <a href="/projekt-kultura/admin.php/?page=main" class="btn btn-dark btn-lg mr-4"> STRONA GŁÓWNA </a>
            <button type="submit" class="btn btn-lg btn-success"> ZMIEŃ </button>
        </div>

    </form>

</section>
