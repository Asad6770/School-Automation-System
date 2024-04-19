<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "st") {
        header("Location: ../not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';

        $q = "SELECT assignment.*,
        book.name as book_name
        FROM assignment 
        INNER JOIN book ON assignment.book_id = book.id 
        where assignment.id = " . $_GET['id'] . " ";
        $data = query($q);
        // print_r($data);
?>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center text-uppercase font-weight-bold mt-4"><?= $data[0]['assignment_title'] ?></h5>
                </div>
                <h5 class="text-center text-uppercase"><?= $data[0]['book_name'] ?></h5>
                <hr class="sidebar-divider">
                <div class="card-body">
                    <form action="process.php" method="post" class="submitData">
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
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>

<script>
    ClassicEditor
        .create(document.querySelector('#answer'))
        .catch(error => {
            console.error(error);
        });
</script>