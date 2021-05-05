<link href="/projekt-kultura/public/styles/workshops.css" rel="stylesheet">

<section class="container mb-5 mt-5">

    <div class="d-flex justify-content-center">
        <h1 id="title" class="font-weight-bold mb-0 text-center font-italic text-uppercase"
            style="font-family: 'Lora', serif;">
            <?php echo $params['workshop']['name'] ?> </h1>
    </div>
    <div id="box" class="mx-auto mb-5"></div>

    <div class="row justify-content-center mb-5">

        <div class="col-md-5 col-sm-8 col-10 mb-4">
            <?php for($i=1; $i<=5; $i++): ?>
            <?php $fileName = "/projekt-kultura/public/graphics/workshops/{$params['workshop']['name']}_$i.png"; ?>
            <br>
            <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].$fileName)): ?>
             <img src="<?php echo $fileName ?>"
                class="w-100 mb-4">
            <?php endif; ?>
            <?php endfor; ?>
        </div>
        <div class="col-md-7 col-12 mb-4">
            <p class="text-justify mb-0" style="font-size: 17px;"> <?php echo $params['workshop']['description'] ?> </p>

            <?php if($params['workshop']['for_sale']): ?>
            <a class="btn btn-lg btn-success my-5 ml-4" href="/projekt-kultura/?page=paymentFormWorkshop&name=<?php echo $params['workshop']['name'] ?>"> KUP
            <?php echo $params['workshop']['price'] ?> zł </a>
            <?php endif; ?>
        </div>

    </div>

</section>

<script>
    if(window.innerWidth <= (Number(document.getElementById('title').offsetWidth) + 100)){
        document.getElementById('box').style.width = (Number(document.getElementById('title').offsetWidth) + 0) +"px";
    }else{
        document.getElementById('box').style.width = (Number(document.getElementById('title').offsetWidth) + 50) +"px";
    }
</script>
