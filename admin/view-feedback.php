<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$id = $_GET['id'];
$parent_id = $_GET['parent_id'];

$q = 'SELECT feedback.* , parent.fullname as parent_name FROM parent INNER JOIN feedback ON feedback.parent_id = parent.id   
WHERE feedback.id = ' . $id . ' AND parent_id = ' . $parent_id . '';
$data = query($q);
?>

<h5 class="card-title font-weight-bold text-uppercase"><?= $data[0]['title'] ?></h5>
<p class="card-text"><?= $data[0]['description'] ?></p>
<footer class="blockquote-footer"><span class="font-weight-bold text-uppercase"><?= $data[0]['parent_name'] ?></span>
        <cite title="Source Title"><?= date_format(new DateTime($data[0]['date']), 'd-F-Y h:i:s') ?></cite>
</footer>