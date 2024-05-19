<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
session_start();

if (isset($_GET['class_id'])) {
    $where = 'class_id=' . $_GET['class_id'];
    $data = select('book', '*', $where);

    if (count($data) > 0) {
        $output = '<option value="">Select a Book</option>';
        foreach ($data as $value) {
            $output .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }
    } else {
        $output = '<option value="">Select a Book</option>';
        $output .= '<option>No Books Found</option>';
    }
    echo $output;
}

if (@$_POST['type'] == 'create') {

    $errors = [];

    if (empty($_POST['class_id'])) {
        $errors['class_id'] = "Class is Required!";
    }

    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book is Required!";
    }

    if (empty($_POST['lecture_no'])) {
        $errors['lecture_no'] = "Lecture No is Required!";
    }

    if (empty($_POST['lecture_title'])) {
        $errors['lecture_title'] = "Lecture Title is Required!";
    }

    if (empty($_FILES['lecture']['name'])) {
        $errors['lecture'] = "Lecture Detail is Required!";
    } else {
        if ($_FILES['lecture']['error'] !== 0) {
            $errors['lecture'] = "There was an error uploading your file!";
        } else {
            $file_size = $_FILES['lecture']['size'];
            $file_type = pathinfo($_FILES['lecture']['name'], PATHINFO_EXTENSION);
            $allowed_types = array('mp4', 'docx', 'doc', 'pdf');
            if (!in_array($file_type, $allowed_types)) {
                $errors['lecture'] = "Only MP4, DOCX, DOC, and PDF files are allowed!";
            } else {
                $target_dir = "../../assets/upload/";
                $target_file = $target_dir . basename($_FILES["lecture"]["name"]);
                if (move_uploaded_file($_FILES["lecture"]["tmp_name"], $target_file)) {
                    $lecture_path = $target_file;
                } else {
                    $errors['lecture'] = "There was an error moving your file!";
                }
            }
        }
    }


    if (empty($errors)) {
        $data = [
            'class_id' => $_POST['class_id'],
            'book_id' => $_POST['bookSelect'],
            'lecture_no' => $_POST['lecture_no'],
            'lecture_title' => $_POST['lecture_title'],
            'lecture' => $lecture_path,
            'teacher_id' => $_SESSION['id'],
        ];
        $insert = insert('lectures', $data);
        echo json_encode($insert);
    } else {
        echo json_encode(['status' => false, 'error' => $errors]);
    }
    exit();
}


if (@$_POST['type'] == 'edit') {

    $errors = [];

    if (empty($_POST['class_id'])) {
        $errors['class_id'] = "Class is Required!";
    }

    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book is Required!";
    }

    if (empty($_POST['lecture_no'])) {
        $errors['lecture_no'] = "Lecture No is Required!";
    }

    if (empty($_POST['lecture_title'])) {
        $errors['lecture_title'] = "Lecture Title is Required!";
    }

    $lecture_path = null;
    if (!empty($_FILES['lecture']['name'])) {
        if ($_FILES['lecture']['error'] !== 0) {
            $errors['lecture'] = "There was an error uploading your file!";
        } else {
            $file_size = $_FILES['lecture']['size'];
            $file_type = pathinfo($_FILES['lecture']['name'], PATHINFO_EXTENSION);
            $allowed_types = array('mp4', 'docx', 'doc', 'pdf');
            if (!in_array($file_type, $allowed_types)) {
                $errors['lecture'] = "Only MP4, DOCX, DOC, and PDF files are allowed!";
            } else {
                $target_dir = "../../assets/upload/";
                $target_file = $target_dir . basename($_FILES["lecture"]["name"]);
                if (move_uploaded_file($_FILES["lecture"]["tmp_name"], $target_file)) {
                    $lecture_path = $target_file;
                } else {
                    $errors['lecture'] = "There was an error moving your file!";
                }
            }
        }
    }

    if (empty($errors)) {
        
        $data = [
            'class_id' => $_POST['class_id'],
            'book_id' => $_POST['bookSelect'],
            'lecture_no' => $_POST['lecture_no'],
            'lecture_title' => $_POST['lecture_title'],
            'teacher_id' => $_SESSION['id'],
        ];
        if ($lecture_path) {
            $data['lecture'] = $lecture_path;
        }
        $where = 'id= ' . $_POST['id'];
        $update = update('lectures', $data, $where);
        echo json_encode($update);
    } else {
        $data = ['status' => empty($errors), 'error' => $errors];
        echo json_encode($data);
    }
    exit();
}


if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('lectures', $where);
    echo json_encode($insert);
    exit();
};
