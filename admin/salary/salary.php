<?php
require_once '../../include/admin-config.php';
require_once '../../include/header.php';
require_once '../../include/function.php';

$q = 'SELECT salary.*, teacher.fullname AS teacher_name, teacher.username AS teacher_username FROM salary 
INNER JOIN teacher ON salary.teacher_id = teacher.id';
$data = query($q);
?>
<div class="container-fluid">
    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Salary Details</h5>
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
                            <th>Teacher Name</th>
                            <th>Teacher Id</th>
                            <th>Salary Month</th>
                            <th>Salary Year</th>
                            <th>Basic Salary</th>
                            <th>Allowances</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Teacher Name</th>
                            <th>Teacher Id</th>
                            <th>Salary Month</th>
                            <th>Salary Year</th>
                            <th>Basic Salary</th>
                            <th>Allowances</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data as $key => $value) {
                            echo  ' <tr class="text-capitalize">
                                        <th>' . $key + 1 . '</th>
                                        <td>' . $value['teacher_name'] . '</td>
                                        <td class="text-uppercase">' . $value['teacher_username'] . '</td>
                                        <td>' . date('F', mktime(0, 0, 0, $value['salary_month'], 1)) . '</td>
                                        <td>' . $value['salary_year'] . '</td>
                                        <td>rs ' . $value['basic_salary'] . '</td>
                                        <td>rs ' . $value['allowances'] . '</td>
                                        <td>
                                            <a class="text-white btn btn-success btn-sm modal-load" href="edit.php?id='
                                . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Edit</a> |
                                            <a class="text-white btn btn-danger  btn-sm delete" href="process.php" data-id="' . $value['id'] . '">Delete</a>        
                                            </td>
                                    </tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../../include/footer.php';
?>