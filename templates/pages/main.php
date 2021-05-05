<link href="/projekt-kultura/public/styles/index.css" rel="stylesheet">

<?php 
    $posts = $params['posts'] ?? [];

    $page = $params['page'] ?? [];
    $pageSize = $page['size'];
    $currentPage = $page['current'];
    $numberOfPages = $page['number'];

    var_dump($posts);
?>

<section class="container mb-4 mt-5">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="12000">
        <ol class="carousel-indicators">
            <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner1.png")): ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <?php endif; ?>
            <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner2.png")): ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <?php endif; ?>
            <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner3.png")): ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <?php endif; ?>
        </ol>

        <div class="carousel-inner">
            <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner1.png")): ?>
                <div class="carousel-item active">
                    <img src="/projekt-kultura/public/graphics/baners/baner1.png" class="d-block w-100" height="100%"
                        alt="Baner 1">
                </div>
            <?php endif; ?>
            
            <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner2.png")): ?>
                <div class="carousel-item">
                    <img src="/projekt-kultura/public/graphics/baners/baner2.png" class="d-block w-100" alt="Baner 2">
                </div>
            <?php endif; ?>

            <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner3.png")): ?>
                <div class="carousel-item">
                    <img src="/projekt-kultura/public/graphics/baners/baner3.png" class="d-block w-100" alt="Baner 3">
                </div>
            <?php endif; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</section>


<section class="container py-5">

    <h2 class="font-weight-bold text-center mb-5 text-uppercase font-italic" style="font-family: 'Lora', serif;">
        Aktualności </h2>

    <div class="row w-xl-75 w-lg-100 mx-auto" id="main">

        <?php foreach($posts as $post): ?>
        <a href="/projekt-kultura/?page=blog&name=<?php echo $post['title'] ?>"
            class="text-decoration-none d-flex align-items-stretch mb-4 col-xl-5 col-lg-5 col-md-6 col-10">
            <div class="card">
                <button class="bg-white border-0 px-0" type="submit">
                    <div class="card-body pb-0">
                        <h4 class="card-title font-weight-bold mb-0 text-center pb-3"
                            style="font-family: 'Bitter', serif;"> <?php echo $post['title'] ?> </h4>
                    </div>
                    <img class="card-img-top" src="/projekt-kultura/public/graphics/posts/<?php echo $post['title'] ?>.png"
                        alt="Post na blogu">
                    <div class="card-body py-2">
                        <p class="mb-0 text-justify"> <?php echo $post['description'] ?> </p>
                        <p class="font-weight-normal date py-1 mb-0 text-left">
                        <?php echo $post['created'] ?> </p>
                    </div>
                </button>
            </div>
        </a>

        <?php endforeach; ?>

    </div>

    <ul class="d-flex justify-content-center mx-auto mt-4 mb-4 font-weight-bold" id="pagination">
       
       <?php if($currentPage > 1): ?>
        <a href="/projekt-kultura/?pageNumber=<?php echo ($currentPage-1) ?>">
            <li class="list-group-item">
                <<
            </li>
        </a>
        <?php endif; ?>

       <?php for($i=1; $i <= $numberOfPages; $i++): ?>
        <a href="/projekt-kultura/?pageNumber=<?php echo $i ?>">
            <li class="list-group-item">
                <?php echo $i ?> 
            </li>
        </a>
       <?php endfor; ?>

        
       <?php if($currentPage < $numberOfPages): ?>
        <a href="/projekt-kultura/?pageNumber=<?php echo ($currentPage+1) ?>">
            <li class="list-group-item">
                >>
            </li>
        </a>
        <?php endif; ?>

    </ul>

</section>
