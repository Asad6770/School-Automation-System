<?php
require_once '../include/admin-config.php';
require_once '../include/header.php';
require_once '../include/function.php';

$data = select('feedback', '*');

?>
<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Feedbacks</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>View Detail</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>View Detail</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data as $value) {
                            @$index += 1;
                            echo  '
                                        <tr class="text-capitalize">
                                            <td>' . $index . '</td>
                                            <td>' . $value['title'] . '</td>
                                            <td>' .  mb_strimwidth($value['description'], 0, 50, '...') . '</td>
                                            <td>
                                                <a class="text-white btn btn-success modal-load" href="view-feedback.php?id='
                                . $value['id'] . '&parent_id=' . $value['parent_id'] . '" data-toggle="modal" data-target="#exampleModal">View</a>        
                                             </td>
                                        </tr>';
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