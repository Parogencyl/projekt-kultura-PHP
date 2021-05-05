<link href="/projekt-kultura/public/styles/courses.css" rel="stylesheet">

<?php
    $course = $params['course'];
?>

<section class="container mb-5 mt-5">

    <h1 class="font-weight-bold text-center"> <?php echo $course['title'] ?> </h1>

    <h4 class="text-center mb-5"> Poniżej znajduje się cały film szkoleniowy udostępniony dla ciebie.
    </h4>


    <div class="row justify-content-center mb-5">

        <div class="col-lg-5 col-md-6 col-12 mb-5">
            <video width="100%" height="100%" controls controlsList="nodownload" disablePictureInPicture
                style="object-fit: cover">
                <source src="/projekt-kultura/public/graphics/courses/<?php echo $course['title'] ?>.mp4" type="video/mp4">
            </video>
            <p class="text-center font-weight-bold"> Film szkoleniowy - <?php echo $course['title'] ?> </p>
        </div>

    </div>


</section>

<script>
    $(document).ready(function(){
        $('video').bind('contextmenu',function() { return false; });
    });
</script>
