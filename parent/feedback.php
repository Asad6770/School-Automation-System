<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "pt") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';
?>

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Feedback</h5>
                    <?php
                    if (isset($_SESSION['message'])) {
                        $message_class = strpos($_SESSION['message'], 'Error') !== false ? 'error' : 'success';
                        echo "<div class='message $message_class'>{$_SESSION['message']}</div>";
                        unset($_SESSION['message']);
                    }
                    ?>
                    <form action="process.php" method="POST" autocomplete="off">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Feedback Title</label>
                            <input type="text" name="title" class="form-control" id="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Feedback Description</label>
                            <textarea name="description" class="form-control" id="" rows="8" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Feedback</button>
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