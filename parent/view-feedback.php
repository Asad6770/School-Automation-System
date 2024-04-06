<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "pt") {
        echo "<div 
        style='position: fixed; top: 50%; left: 50%;
        transform: translate(-50%, -50%); 
        background-color: #f44336;
        color: white; padding: 20px;
        font-size: 20px;
        '>
        Access Denied
    </div>";
    } else {
        require_once 'include/header.php';
        require_once 'include/function.php';

        $q = 'SELECT feedback.*, parent.fullname 
        AS parent_name
        FROM feedback 
        INNER JOIN parent 
        ON feedback.parent_id = parent.id 
        WHERE feedback.parent_id = ' . $_SESSION['id'];
        $data = query($q);
?>

        <div class="container-fluid">
            <div class="card">
                <h5 class="card-title text-center mt-4">Feedback</h5>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Feedback</th>
                                <th scope="col">Create By</th>
                                <th scope="col">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $value) {

                                echo  ' <tr>
                        <th>' . $value['title'] . '</th>
                        <td>' . $value['description'] . '</td>
                        <td>' . $value['parent_name'] . '</td>
                        <td>' . date_format(new DateTime($value['date']), 'd-F-Y h:i:s') . '</td>
                    </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'include/footer.php';
?>