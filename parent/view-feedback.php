<?php
require_once '../include/parent-config.php';
require_once '../include/header.php';
require_once '../include/function.php';

$q = 'SELECT feedback.*, parent.fullname AS parent_name FROM feedback INNER JOIN parent ON feedback.parent_id = parent.id 
WHERE feedback.parent_id = ' . $_SESSION['id'];
$data = query($q);
?>

<div class="container-fluid">
    <div class="card">
        <h5 class="card-title text-center mt-4">List of Feedback</h5>
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $value) {
                        echo  ' <tr>
                                    <th>' . $value['title'] . '</th>
                                    <td>' . $value['description'] . '</td>
                                    <td>' . date_format(new DateTime($value['date']), 'd-F-Y h:i:s') . '</td>
                                </tr>
                    ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once '../include/footer.php';
?>