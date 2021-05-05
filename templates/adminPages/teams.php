<?php
if($params['success']){
    if($params['success'] === 'deleted'){
        $success = "Wybrany post został usunięty.";
    }
}
?>

<link href="/projekt-kultura/public/styles/workshops.css" rel="stylesheet">

<section class="container mb-5 mt-5">

    <?php if($success != ''): ?>
        <div class="alert alert-success alert-block col-12 my-3">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> <?php echo $success ?> </strong>
        </div>
    <?php endif; ?>

    <h1 class="font-weight-bold text-center mb-3"> Zespoły </h1>

    <h4 class="text-center mb-5"> Przyjaciele Stowarzyszenia Inicjatyw Społecznych „PROJEKT KULTURA” to naprawdę
        utalentowane osoby. Możecie się o tym przekonać zapraszając ich na swoje wydarzenie. </h4>

    <div class="row justify-content-center">
        <a href="/projekt-kultura/admin.php/?page=addTeam" class="btn btn-lg btn-success mb-5 mt-2"> DODAJ NOWY ZESPÓŁ </a>
    </div>

    <div class="row mb-5" id="main">

    <?php foreach($params['teams'] ?? [] as $param): ?>
        <a href="/projekt-kultura/admin.php/?page=manageTeam&name=<?php echo $param['name'] ?>"
            class="col-lg-5 col-md-6 col-10 d-flex align-items-stretch position-relative warsztatyDiv mb-4">
            <img src="/projekt-kultura/public/graphics/teams/<?php echo $param['name'] ?>_1.png" class="w-100" alt="<?php echo $param['name'] ?>">
            <div class="position-absolute text-center text-white warsztatTekst" style="z-index: 1; bottom: 0">
                <div class="col-12 font-weight-bold" style="font-family: 'Bitter', serif;"> <?php echo $param['name'] ?>
                </div>
            </div>
        </a>
        <?php endforeach; ?>

    </div>

</section>