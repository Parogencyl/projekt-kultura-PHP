<link href="/projekt-kultura/public/styles/index.css" rel="stylesheet">

<?php
    $posts = $params['posts'] ?? [];

    $page = $params['page'] ?? [];
    $pageSize = $page['size'];
    $currentPage = $page['current'];
    $numberOfPages = $page['number'];

    $error = $success = '';
    if($params['error']){
        if($params['error'] === 'add'){
            $error = "Nie udało się dodać baneru.";
        } else if($params['error'] === 'delete'){
            $error = "Nie udało się usunąć baneru.";
        } 
    }

    if($params['success']){
        if($params['success'] === 'added'){
            $success = "Baner został dodany.";
        }else if($params['success'] === 'deleted'){
            $success = "Baner został usunięty.";
        } 
    }
?>

<section class="container mb-4 mt-5">

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

<?php if(!file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner3.png")): ?>
    <form action="/projekt-kultura/admin.php/?page=main&action=addBaner" method="POST" enctype="multipart/form-data" class="mb-5 w-50 mx-auto">
        <div
            class="text-center border border-success py-5 image-upload bg-success d-flex align-items-center justify-content-center">
            <label for="file-input3">
                <i class="fas fa-plus text-white py-5" style="font-size: 80px;"></i>
            </label>
            <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner2.png")): ?>
                <input type="text" name="el" value="3" class="d-none">
            <?php elseif(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner1.png")): ?>
                <input type="text" name="el" value="2" class="d-none">
            <?php else: ?>
                <input type="text" name="el" value="1" class="d-none">
            <?php endif; ?>
            <input id="file-input3" type="file" name="baner" onchange="form.submit()">
        </div>
    </form>
<?php endif; ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="12000">

        <div class="carousel-inner">

            <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner1.png")): ?>
                <div class="carousel-item active">
                    <img src="/projekt-kultura/public/graphics/baners/baner1.png" class="d-block w-100" height="100%"
                        alt="Baner 1">
                    <?php if(!file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner2.png")): ?>
                        <div class="dustbin carousel-inner d-flex align-items-center justify-content-center">
                            <form action="/projekt-kultura/admin.php/?page=main&action=deleteBaner" method="POST" class="m-2">
                                <input type="text" name="el" value="1" class="d-none">
                                <button type="submit"> <i class="fas fa-trash-alt"> </i> </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner2.png")): ?>
                    <div class="carousel-item">
                        <img src="/projekt-kultura/public/graphics/baners/baner2.png" class="d-block w-100" alt="Baner 2">
                    </div>
                    <?php if(!file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner3.png")): ?>
                        <div class="dustbin carousel-inner d-flex align-items-center justify-content-center">
                            <form action="/projekt-kultura/admin.php/?page=main&action=deleteBaner" method="POST" class="m-2">
                                <input type="text" name="el" value="2" class="d-none">
                                <button type="submit"> <i class="fas fa-trash-alt"> </i> </button>
                            </form>
                        </div>
                    <?php endif; ?>

                    <?php if(file_exists("C:/xampp/htdocs/projekt-kultura/public/graphics/baners/baner3.png")): ?>
                    <div class="carousel-item">
                        <img src="/projekt-kultura/public/graphics/baners/baner3.png" class="d-block w-100" alt="Baner 3">
                        <div class="dustbin carousel-inner d-flex align-items-center justify-content-center">
                            <form action="/projekt-kultura/admin.php/?page=main&action=deleteBaner" method="POST" class="m-2">
                                <input type="text" name="el" value="3" class="d-none">
                                <button type="submit"> <i class="fas fa-trash-alt"> </i> </button>
                            </form>
                        </div>
                    </div>
            <?php endif; ?>
            <?php endif; ?>
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

    <div class="row justify-content-center">
        <a href="/projekt-kultura/admin.php/?page=addPost"
            class="text-center mb-5 col-xl-4 col-lg-5 col-md-6 col-10 p-5 bg-success">
            <i class="fas fa-plus text-white py-5" style="font-size: 80px;"></i>
        </a>
    </div>

<div class="row w-xl-75 w-lg-100 mx-auto" id="main">

    <?php foreach($posts as $post): ?>
    <a href="/projekt-kultura/admin.php/?page=managePost&name=<?php echo $post['title'] ?>"
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
    <a href="/projekt-kultura/admin.php/?pageNumber=<?php echo ($currentPage-1) ?>">
        <li class="list-group-item">
            <<
        </li>
    </a>
    <?php endif; ?>

   <?php for($i=1; $i <= $numberOfPages; $i++): ?>
    <a href="/projekt-kultura/admin.php/?pageNumber=<?php echo $i ?>">
        <li class="list-group-item">
            <?php echo $i ?> 
        </li>
    </a>
   <?php endfor; ?>

    
   <?php if($currentPage < $numberOfPages): ?>
    <a href="/projekt-kultura/admin.php/?pageNumber=<?php echo ($currentPage+1) ?>">
        <li class="list-group-item">
            >>
        </li>
    </a>
    <?php endif; ?>

</ul>

</section>
