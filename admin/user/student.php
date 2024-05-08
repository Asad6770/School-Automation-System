<?php
require_once 'C:\xampp\htdocs\SAS\include\admin-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$q = 'SELECT student.*, class.name as class_name FROM student INNER JOIN class ON student.class_id = class.id';
$data = query($q);
//    print_r($data);
//    exit();
?>

<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Students</h5>
            <button href="create-student.php" type="button" class="btn btn-primary modal-load" data-toggle="modal" data-target="#exampleModal">
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
                            <th>Father Name</th>
                            <th>Username</th>
                            <th>Phone No</th>
                            <th>Address</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Fullname</th>
                            <th>Father Name</th>
                            <th>Username</th>
                            <th>Phone No</th>
                            <th>Address</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data as $value) {
                            @$index += 1;
                            echo  '
                                     <tr class="text-capitalize">
                                        <td>' .  @$index . '</td>
                                        <td>' . $value['fullname'] . '</td>
                                        <td>' . $value['father_name'] . '</td>
                                        <td class="text-uppercase">' . $value['username'] . '</td>
                                        <td>' . $value['phone_no'] . '</td>
                                        <td>' . $value['address'] . '</td>
                                        <td>' . $value['class_name'] . '</td>
                                        <td>
                                            <a class="text-white btn btn-success modal-load" href="edit-student.php?id='
                                . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Edit</a> | 
                                            <a class="text-white btn btn-danger delete" href="process.php"  
                                            data-id="' . $value['id'] . '">Delete</a>        
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