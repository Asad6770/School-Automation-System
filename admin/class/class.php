<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 5) != "admin") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {

        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';
        $data = select('class', '*')
?>

        <div class="container-fluid">

            <div class="card input-group-sm mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h5 class="card-title text-center mt-4 font-weight-bold">Class</h5>
                    <button href="create.php" type="button" class="btn btn-primary btn-sm modal-load" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-plus"></i>
                        Create New
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Noun</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S No</th>
                                    <th>Noun</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                foreach ($data as $value) {
                                    @$index += 1;
                                    echo  '
                                        <tr class="text-capitalize">
                                            <td>' . $index . '</td>
                                            <td>' . $value['name'] . '</td>
                                            <td>' . date_format(new DateTime($value['date']), 'd-F-Y h:i:s') . '</td>
                                            <td>
                                                <a class="text-white btn btn-success btn-sm modal-load" href="edit.php?id='
                                        . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Edit</a> |
                                        <a class="text-white btn btn-danger  btn-sm delete" href="process.php" data-id="' . $value['id'] . '">Delete</a>        
                                            </td>
                                        </tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>