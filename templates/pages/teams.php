<link href="/projekt-kultura/public/styles/workshops.css" rel="stylesheet">

<section class="container mb-5 mt-5">

    <h1 class="font-weight-bold text-center mb-3 font-italic" style="font-family: 'Lora', serif;"> ZESPOŁY </h1>

    <h3 class="text-center mb-5 font-weight-normal" style="font-family: 'Lora', serif;"> Przyjaciele Stowarzyszenia
        Inicjatyw Społecznych „PROJEKT KULTURA” to naprawdę
        utalentowane osoby. Możecie się o tym przekonać zapraszając ich na swoje wydarzenie. </h3>

    <div class="row mb-5" id="main">

    <?php foreach($params['teams'] ?? [] as $param): ?>
        <a href="/projekt-kultura/?page=team&name=<?php echo $param['name'] ?>"
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
