<?php
require_once '../../include/teacher-config.php';
require_once '../../include/header.php';
require_once '../../include/function.php';
$data = select('lectures', '*', 'id='.$_GET['id']);

?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-capitalize mt-4 font-weight-bold">Lecture No <?= $data[0]['lecture_no'] ?></h5>
        </div>
        <div class="card-body d-flex flex-row align-items-center justify-content-center">
        <iframe width="700" height="500"
        src="https://www.youtube.com/embed/<?=$_GET['file']?>?rel=0&modestbranding=1&disablekb=1&fs=0" 
        title="YouTube video player" 
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen></iframe>

        </div>
    </div>
</div>

<?php
require_once '../../include/footer.php';
?>