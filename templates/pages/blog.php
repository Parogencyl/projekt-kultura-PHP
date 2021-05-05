<link href="/projekt-kultura/public/styles/index.css" rel="stylesheet">

<section class="container mb-4 mt-5">

    <h1 class="font-weight-bold text-center mb-5 mt-2 font-italic" style="font-family: 'Lora', serif;">
        <?php echo $params['article']['title'] ?> </h1>

    <p class="text-justify mb-5" style="font-size: 18px;"> <?php echo $params['article']['text'] ?> </p>

    <div class="col-xl-7 col-md-9 col-12 mx-auto">
        <img src="/projekt-kultura/public/graphics/posts/<?php echo $params['article']['title'] ?>.png" class="w-100"
            alt="<?php echo $params['article']['title'] ?>">
    </div>
</section>
