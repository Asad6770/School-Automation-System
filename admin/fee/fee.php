<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 5) != "admin") {
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

        require_once '../include/header.php';
        require_once '../function.php';
        $data = select('class', '*')
?>

        <div class="container-fluid">

            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h5 class="card-title text-center mt-4 font-weight-bold">Fee Detail</h5>
                    <button href="create.php" type="button" class="btn btn-primary modal-load" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-plus"></i>
                        Add Fee
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Student Name</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Paid Date</th>
                                    <th>Vocher</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>S No</th>
                                    <th>Student Name</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Paid Date</th>
                                    <th>Vocher</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                //                         foreach ($data as $value) {
                                //                             @$index += 1; 
                                //                             echo  ' <tr class="text-capitalize">
                                //                             <td>' . $index . '</td>
                                //                 <td>' . $value['name'] . '</td>
                                //                 <td>' . date_format(new DateTime($value['date']), 'd-F-Y h:i:s') . '</td>
                                //                 <td>
                                // <a class="text-white btn btn-success modal-load" href="edit.php?id=' . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Edit</a> |
                                // <a class="text-white btn btn-danger delete" href="process.php?id=' . $value['id'] . '">Delete</a>        
                                // </td>
                                //             </tr>';
                                //                         }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </table>
        </div>

<?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once '../include/footer.php';
?>