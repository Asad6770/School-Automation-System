<?php
require_once 'C:\xampp\htdocs\SAS\include\student-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$where = 'student_id='.$_SESSION['id'] . ' AND assignment_id='.$_GET['id'];
$assignment = select('submission', '*', $where);

if (@$assignment[0] > 0) {
    echo "<script>window.location.href = 'http://localhost:90/SAS/student/assignment/assignment.php?id=" . $_GET['id'] . "';</script>";
}


$q = "SELECT assignment.*, book.name as book_name FROM assignment INNER JOIN book ON assignment.book_id = book.id 
where assignment.id = " . $_GET['id'] . " ";
$data = query($q);
// print_r($data);
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center text-uppercase font-weight-bold mt-4"><?= $data[0]['assignment_title'] ?></h5>
        </div>
        <h5 class="text-center text-uppercase mt-3"><?= $data[0]['book_name'] ?></h5>
        <hr class="sidebar-divider">
        <div class="card-body">
            <form action="process.php" method="post" class="assignment">
                <input type="hidden" class="form-control" name="type" value="submission">
                <input type="hidden" class="form-control" name="assignment_id" value="<?= $_GET['id'] ?>">

                <div class="row justify-content-left">

                    <div class="col-12">
                        <?= $data[0]['question'] ?>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 mt-4">
                        <label class="font-weight-bold" for="answer">Assignment Answer</label>
                        <textarea name="answer" id="answer"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 col-2">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>

<script>
    ClassicEditor
        .create(document.querySelector('#answer'))
        .catch(error => {
            console.error(error);
        });
        

        $(document).on('submit', '.assignment', function (e) {
        e.preventDefault();
        // console.log('click');
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            dataType: 'json',
            processData: false,
            success: function (data) {
                console.log(data)
                if (data.status == true) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.msg,
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'http://localhost:90/SAS/student/assignment/assignment.php?id=<?=$_GET['id']?>';
                        }
                    });
                } else {

                    if (data.status == false) {
                        $('.error').text('');
                        $.each(data.error, function (key, value) {
                            $('.' + key + '_error').text(value);
                            // console.log('.' + key + '_error');
                        });
                    }
                }
            }
        });
    });


</script>