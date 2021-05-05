<link href="/projekt-kultura/public/styles/courses.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400;700&display=swap" rel="stylesheet">

<?php
    $index = 0;

    $key = $error = '';
    if($params['key']){
        $key = "Dostęp do kursu {$params['name']} udostępniony zapomocą klucza {$params['key']}";
    }

    if($params['error']){
        if($params['error'] === 'notValidKey'){
            $error = "Podany klucz jest niepoprawny lub stracił ważność.";
        }
    }
?>

<section class="container mb-5 mt-5">

    <?php if($key != ''): ?>
        <div class="alert alert-success alert-block col-12 my-3">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> <?php echo $key ?> </strong>
        </div>
    <?php endif; ?>

    <?php if($error != ''): ?>
        <div class="alert alert-danger alert-block col-12 my-3">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> <?php echo $error ?> </strong>
        </div>
    <?php endif; ?>

    <h1 class="font-weight-bold text-center mb-3 font-italic" style="font-family: 'Lora', serif;"> SZKOLENIA </h1>

    <h4 class="text-center mb-5" style="font-family: 'Lora', serif;"> Stowarzyszenie Inicjatyw Społecznych „PROJEKT
        KULTURA” zaprasza do udziału w szkoleniach dla kadr kultury i organizacji pozarządowych.
    </h4>


    <div class="row justify-content-center">

        <div class="col-lg-6 col-md-8 col-11 mb-5">
            <video width="100%" height="100%" controls controlsList="nodownload" style="object-fit: cover"
                disablePictureInPicture poster='/projekt-kultura/public/graphics/Logo.png'
                src="/projekt-kultura/public/graphics/szkoleniaReklama.mp4" type="video/mp4">
            </video>
        </div>

    </div>

    <hr class="mb-5 mt-5">

    <p class="font-weight-bold text-danger d-none" style="font-size: 15px;"> Jeśli jeszcze nie posiadasz klucza dostępu
        zachęcamy do zakupu wybranego przez siebie kursu w naszym serwisie. </p>

    <h1 class="text-center font-weight-bold mt-0 mb-5 font-italic font-uppercase" style="font-family: 'Lora', serif;">
        DOSTĘPNE
        KURSY
    </h1>

    <?php foreach($params['courses'] ?? [] as $param): ?>
    <div class="lesson pt-3">
        <h2 class="font-weight-bold mb-0" style="font-family: 'Bitter', serif;"> <?php echo $param['title'] ?>
        </h2>
        <div class="row align-items-middle pt-3">
            <div class="col-md-8 col-12 pl-md-4 pl-3 align-self-center">
                <div style="font-size: 20px;"> <span class="font-weight-bold"> Czas kursu (h):
                    </span>
                    <span class="text-white bg-success numberCourse">
                        <?php echo $params['courseDuration'][$index] ?>
                    </span> </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="row">
                    <h3 class="font-weight-bold text-success text-center col-12 pt-3 pt-sm-0" style="font-size: 30px;">
                    <?php echo $param['price1'] ?> zł
                    </h3>
                    <a href="/projekt-kultura/?page=paymentFormCourse&name=<?php echo $param['title'] ?>&variant=1" id="buy"
                        class="btn btn-lg btn-danger mt-1 mb-2 col-12"> Wykup
                        dostęp
                    </a>
                </div>
            </div>
        </div>


        <div id="plusy" class="mt-3">
            <h3 class="font-weight-bold mb-3" style="font-family: 'Bitter', serif;"> Czego się nauczysz? </h3>
            <div class="pl-3">
                <?php foreach($param['about'] ?? [] as $value): ?>
                    <p> <i class="far fa-check-circle text-success"></i> <span class="font-weight-bold"
                            style="font-size: 17px">
                            <?php echo $value ?> </span> </p>
                            <?php endforeach; ?>
            </div>
        </div>

        <div class="row justify-content-center">
            <button type="button" class="btn btn-lg btn-dark kursShow" style="font-family: 'Bitter', serif;"> WIĘCEJ
            </button>
        </div>

        <div class="kursHide">

            <div class="py-5">
                <div class="row justify-content-center">

                    <div class="col-lg-5 col-md-8 col-11 mb-3">
                        <video width="100%" height="100%" controls controlsList="nodownload" style="object-fit: cover"
                            src="/projekt-kultura/public/graphics/courses/<?php echo $param['title'] ?>_zwiastun.mp4" disablePictureInPicture
                            type="video/mp4">
                        </video>
                        <p class="text-center font-weight-bold mb-0" style="font-size: 19px"> Zwiastun kursu </p>
                    </div>

                </div>
            </div>

            <div class="row mb-2 mt-5">

            <?php if($param['price3'] == 0): ?>
                <div class="offset-md-2"></div>
            <?php endif; ?>

            <?php if($param['price2'] == 0): ?>
                <div class="offset-md-2"></div>
            <?php endif; ?>

                <div class="col-12 col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <h5 class="card-header font-weight-bold text-center" style="font-family: 'Bitter', serif;">
                            WARIANT I
                        </h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item font-weight-normal text-center">Kurs w postaci filmu</li>
                                <?php for($i=0; $i<$params['variantSize'][$index]; $i++): ?>
                                <?php if(isset($param['variant1'][$i])): ?>
                                <li class="list-group-item font-weight-normal text-center"> <?php echo $param['variant1'][$i] ?> </li>
                                    <?php else: ?>
                                <li class="list-group-item font-weight-normal text-center"> X </li>
                                    <?php endif; ?>
                                    <?php endfor; ?>
                                    <li class="list-group-item text-center text-danger"
                                            style="font-size: 22px; font-family: 'Bitter', serif;">
                                            <?php echo $param['price1'] ?> zł </li>
                        </ul>
                        <div class="bg-danger h-100">
                            <a href="/projekt-kultura/?page=paymentFormCourse&name=<?php echo $param['title'] ?>&variant=1"
                                class="btn btn-lg btn-danger w-100 h-100 font-weight-bold d-flex justify-content-center align-items-center"
                                style="font-family: 'Bitter', serif;"> WYKUP
                            </a>
                        </div>
                    </div>

                </div>

                <?php if($param['price2'] != 0): ?>
                <div class="col-12 col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <h5 class="card-header font-weight-bold text-center" style="font-family: 'Bitter', serif;">
                            WARIANT II
                        </h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item font-weight-normal text-center">Kurs w postaci filmu</li>
                            <?php for($i=0; $i<$params['variantSize'][$index]; $i++): ?>
                                <?php if(isset($param['variant2'][$i])): ?>
                                <li class="list-group-item font-weight-normal text-center"> <?php echo $param['variant2'][$i] ?> </li>
                                    <?php else: ?>
                                <li class="list-group-item font-weight-normal text-center"> X </li>
                                    <?php endif; ?>
                                    <?php endfor; ?>
                                    <li class="list-group-item text-center text-danger"
                                            style="font-size: 22px; font-family: 'Bitter', serif;">
                                            <?php echo $param['price2'] ?> zł </li>
                        </ul>
                        <div class="bg-danger h-100">
                            <a href="/projekt-kultura/?page=paymentFormCourse&name=<?php echo $param['title'] ?>&variant=2"
                                class="btn btn-lg btn-danger w-100 h-100 font-weight-bold d-flex justify-content-center align-items-center"
                                style="font-family: 'Bitter', serif;"> WYKUP
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($param['price3'] != 0): ?>
                <div class="col-12 col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <h5 class="card-header font-weight-bold text-center" style="font-family: 'Bitter', serif;">
                            WARIANT III
                        </h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item font-weight-normal text-center">Kurs w postaci filmu</li>
                            </li>
                            <?php for($i=0; $i<$params['variantSize'][$index]; $i++): ?>
                                <?php if(isset($param['variant3'][$i])): ?>
                                <li class="list-group-item font-weight-normal text-center"> <?php echo $param['variant3'][$i] ?> </li>
                                    <?php else: ?>
                                <li class="list-group-item font-weight-normal text-center"> X </li>
                                    <?php endif; ?>
                                    <?php endfor; ?>
                                        <li class="list-group-item text-center text-danger"
                                            style="font-size: 22px; font-family: 'Bitter', serif;">
                                            <?php echo $param['price3'] ?> zł </li>
                        </ul>
                        <div class="bg-danger h-100">
                            <a href="/projekt-kultura/?page=paymentFormCourse&name=<?php echo $param['title'] ?>&variant=3"
                                class="btn btn-lg btn-danger w-100 h-100 font-weight-bold d-flex justify-content-center align-items-center"
                                style="font-family: 'Bitter', serif;"> WYKUP
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>


            <h4 class="font-weight-bold mb-2 mt-5" style="font-family: 'Bitter', serif;"> Przejdź do kursu </h4>

            <form action="/projekt-kultura/?page=coursesShop" method="POST" class="form-inline mt-2 mb-1">
                <input type="hidden" name="name" value="<?php echo $param['title'] ?>">
                <div class="form-group">
                    <input type="text" name="key" class="form-control" id="exampleInputEmail1"
                        placeholder="Klucz dostępu">
                </div>

                <button class="btn btn-success ml-4" style="font-family: 'Bitter', serif;"> Zatwierdź </button>
            </form>

            <small class="form-text text-muted mb-4"> Za pomocą klucza dostępu możliwe jest korzystanie z filmów
                szkoleniowych
                Projekt kultura. </small>
        </div>
    </div>

    <?php $index++; ?>

    <?php if($index != count($params)): ?>
    <hr class="mb-5 mt-5">
    <?php endif; ?>

    <?php endforeach; ?>

</section>

<script>
    for (let i = 0; i < document.getElementsByClassName('kursHide').length; i++) {
        $('.kursHide').hide();
        document.getElementsByClassName('kursShow')[i].addEventListener('click', () => {
            $('.kursHide').eq(i).show(1000);
            document.getElementsByClassName('kursShow')[i].style.display = 'none';
        });
    }

    $(document).ready(function(){
        $('video').bind('contextmenu',function() { return false; });
    });

</script>