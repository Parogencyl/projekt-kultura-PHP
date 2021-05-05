<link href="/projekt-kultura/public/styles/courses.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400;700&display=swap" rel="stylesheet">

<?php
    $index = 0;

    $error = $success = '';
    if($params['error']){
        if($params['error'] === 'uploadAdvertisement'){
            $error = "Nie udało się dodać filmu promocyjnego.";
        } else if($params['error'] === 'deleteAdvertisement'){
            $error = "Nie udało się usunąć filmu promocyjnego.";
        } else if($params['error'] === 'notDeletedVideo'){
            $error = "Nie udało się usunąć filmu.";
        } else if($params['error'] === 'notDeletedCourse'){
            $error = "Nie udało się usunąć kursu.";
        }  
    }

    if($params['success']){
        if($params['success'] === 'uploadedAdvertisement'){
            $success = "Film promocyjny został dodany.";
        } else if($params['success'] === 'deletedAdvertisement'){
            $success = "Film promocyjny został usunięty.";
        } else if($params['success'] === 'deletedCourse'){
            $success = "Kurs został usunięty.";
        } else if($params['success'] === 'deletedData'){
            $success = "Dane kursu zostały usunięte.";
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

    <h1 class="font-weight-bold text-center mb-3"> Szkolenia </h1>

    <h4 class="text-center mb-5"> Stowarzyszenie Inicjatyw Społecznych „PROJEKT
        KULTURA” zaprasza do udziału w
        szkoleniach dla kadr kultury i organizacji pozarządowych.
    </h4>

    <div class="row justify-content-center">

        <div class="col-lg-6 col-md-8 col-11 mb-5">
            <form action="/projekt-kultura/admin.php/?page=coursesShop&action=deleteVideo" method="POST">
                <video width="100%" height="100%" controls controlsList="nodownload" disablePictureInPicture
                    style="object-fit: cover">
                    <source src="{{ asset('/graphics/szkoleniaReklama.mp4') }}"
                        type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                </video>
                <button type="submit" class="btn btn-lg btn-danger mb-3"> USUŃ FILM </button>
            </form>
            <form method="POST" action="/projekt-kultura/admin.php/?page=coursesShop&action=addVideo" enctype="multipart/form-data">
                <input type="file" name="promo" class="mb-3">
                <button type="submit" class="btn btn-lg btn-success mb-3"> DODAJ FILM PROMOCYJNY </button>
            </form>
            <p class="text-center font-weight-bold" style="font-size: 19px"> Nasza działalność </p>
        </div>

    </div>

    <hr class="mb-5 mt-5">

    <p class="font-weight-bold text-danger d-none" style="font-size: 15px;"> Jeśli jeszcze nie posiadasz klucza dostępu
        zachęcamy do zakupu wybranego przez siebie kursu w naszym serwisie. </p>

    <h1 class="text-center font-weight-bold mt-0 mb-5" style="font-family: ' Merriweather Sans', sans-serif;"> DOSTĘPNE
        KURSY
    </h1>

    <?php foreach($params['courses'] ?? [] as $param): ?>
    <div class="lesson pt-3">
        <h3 class="font-weight-bold mb-0" style="font-family: 'Merriweather Sans', sans-serif;">
            <?php echo $param['title'] ?>
        </h3>
        <div class="row align-items-middle pt-5">
            <div class="col-md-8 col-12 pl-md-4 pl-3 align-self-center">
                <div style="font-size: 20px;"> <span class="font-weight-bold"> Czas kursu (h):
                    </span>
                    <span class="text-white bg-success numberCourse">
                         <?php echo $params['courseDuration'][$index] ?>
                    </span> </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="row">
                    <h3 class="font-weight-bold text-success text-center col-12" style="font-size: 30px;">
                    <?php echo $param['price1'] ?> zł
                    </h3>
                    <button id="buy" class="btn btn-lg btn-danger mt-1 mb-2 col-12" disabled> Wykup
                        dostęp
    </button>
                </div>
            </div>
        </div>


        <div id="plusy" class="mt-4">
            <h4 class="font-weight-bold mb-3"> Czego się nauczysz? </h4>
            <div class="pl-3">
            <?php foreach($param['about'] ?? [] as $value): ?>
                    <p> <i class="far fa-check-circle text-success"></i> <span class="font-weight-bold"
                            style="font-size: 17px">
                            <?php echo $value ?> </span> </p>
                            <?php endforeach; ?>
            </div>
        </div>

        <div class="row justify-content-center">
            <button type="button" class="btn btn-lg btn-dark kursShow"> WIĘCEJ </button>
        </div>

        <div class="kursHide">

            <div class="py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8 col-11 mb-3">
                        <video width="100%" height="100%" controls controlsList="nodownload" style="object-fit: cover"
                            disablePictureInPicture src="/projekt-kultura/public/graphics/courses/<?php echo $param['title'] ?>_zwiastun.mp4"
                            type="video/mp4">
                        </video>
                        <p class="text-center font-weight-bold mb-0" style="font-size: 19px"> Zwiastun
                            kursu </p>
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
                        <h5 class="card-header font-weight-bold text-center">
                            WARIANT I
                        </h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item font-weight-normal text-center">Kurs w postaci filmu</li>
                            </li>
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
                            <button
                                class="btn btn-lg btn-danger w-100 h-100 d-flex justify-content-center align-items-center" disabled>
                                WYKUP </button>
                        </div>
                    </div>

                </div>

                <?php if($param['price2'] != 0): ?>
                <div class="col-12 col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <h5 class="card-header font-weight-bold text-center">
                            WARIANT II
                        </h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item font-weight-normal text-center">Kurs w postaci filmu</li>
                            </li>
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
                            <button
                                class="btn btn-lg btn-danger w-100 h-100 d-flex justify-content-center align-items-center" disabled>
                                WYKUP </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($param['price3'] != 0): ?>
                <div class="col-12 col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <h5 class="card-header font-weight-bold text-center">
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
                            <button
                                class="btn btn-lg btn-danger w-100 h-100 d-flex justify-content-center align-items-center" disabled>
                                WYKUP </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>

        </div>

        <div class="row justify-content-center">
            <a href="/projekt-kultura/admin.php/?page=manageCourse&name=<?php echo $param['title'] ?>" class="btn btn-danger btn-lg mt-3 mb-4"> EDYTUJ KURS
            </a>
        </div>

        <?php $index++ ?>

        <?php if($index != count($params)): ?>
        <hr class="mb-5 mt-5">
        <?php endif; ?>


            <?php endforeach; ?>

            <div class="row justify-content-center my-5">
                <a href="/projekt-kultura/admin.php/?page=addCourse" class="btn btn-success btn-lg"> DODAJ NOWY KURS
                </a>
            </div>
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