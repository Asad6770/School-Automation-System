<?php
require_once 'C:\xampp\htdocs\SAS\include\admin-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$data = select('parent', '*')
?>

<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Parents</h5>
            <button href="create-parent.php" type="button" class="btn btn-primary modal-load" data-toggle="modal" data-target="#exampleModal">
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
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Phone No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Phone No</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data as $value) {
                            @$index += 1;
                            echo  ' <tr class="text-capitalize">
                                    <td>' . $index . '</td>
                                    <td>' . $value['fullname'] . '</td>
                                    <td class="text-uppercase">' . $value['username'] . '</td>
                                    <td>' . $value['phone_no'] . '</td>
                                    <td>
                                        <a class="text-white btn btn-success modal-load" href="edit-parent.php?id='
                                . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Edit</a>
                                        |
                                        <a class="text-white btn btn-danger delete" href="process.php" data-id="' . $value['id'] . '">Delete</a>        
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
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>