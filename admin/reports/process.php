<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

if (isset($_GET['class_id'])) {
    $where = 'class_id=' . $_GET['class_id'];
    $data = select('student', '*', $where);

    if (count($data) > 0) {
        $output = '<option value="">Select a Student</option>';
        foreach ($data as $value) {
            $output .= '<option value="' . $value['id'] . '">' . $value['fullname'] . '</option>';
        }
    } else {
        $output = '<option value="">Select a Student</option>';
        $output .= '<option>No Students Found</option>';
    }
    echo $output;
}

if (isset($_GET['student_id'])) {
    $student = 'SELECT * FROM student WHERE id = ' . $_GET['student_id'] . '';
    $students = query($student);
    $where = 'class_id=' . $students[0]['class_id'];
    $data = select('book', '*', $where);

    if (count($data) > 0) {
        foreach ($data as $value) {
            @$output .= '
            <div class="row justify-content-center">
                <div class="form-group col-4">
                    <label class="font-weight-bold mr-3" for="book_id">Book Name</label>
                    <input type="hidden" class="form-control" name="book_id[]" id="book_id" value="' . $value['id'] . '">
                    <input class="form-control bg-white" value="' . $value['name'] . '" readonly>
                </div>

                <div class="form-group col-4">
                    <label class="font-weight-bold" for="obtained_marks">Obtained Marks</label>
                    <input class="form-control" name="obtained_marks[]" id="obtained_marks" >
                    <small class="error obtained_marks_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                </div>
            </div>';
        }
    } else {
        @$output .= '<div class="text-center font-weight-bold mb-1">No data available</div>';
    }
    echo $output;
}



if (@$_POST['type'] == 'create') {

    $errors = [];

    if (empty($_POST['class_id'])) {
        $errors['class_id'] = "Class Field is Required!";
    }

    if (empty($_POST['student_id'])) {
        $errors['student_id'] = "Student Field is Required!";
    }
    if (empty($_POST['total_marks'])) {
        $errors['total_marks'] = "Marks Field is Required!";
    }
    if (empty($_POST['obtained_marks'])) {
        $errors['obtained_marks'] = "Marks Field is Required!";
    } else {
        for ($i = 0; $i < count($_POST['book_id']); $i++) {
            $data = [
                'obtained_marks' => $_POST['obtained_marks'][$i],
                'book_id' => $_POST['book_id'][$i],
                'total_marks' => $_POST['total_marks'],
                'class_id' => $_POST['class_id'],
                'student_id' => $_POST['student_id'],
            ];
            $insert = insert('reports', $data);
        }
        echo json_encode($insert);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['type'] == 'edit') {

    $errors = [];

    if (empty($_POST['class_id'])) {
        $errors['class_id'] = "Class Field is Required!";
    }

    if (empty($_POST['student_id'])) {
        $errors['student_id'] = "Student Field is Required!";
    }
    if (empty($_POST['total_marks'])) {
        $errors['total_marks'] = "Marks Field is Required!";
    }
    if (empty($_POST['obtained_marks'])) {
        $errors['obtained_marks'] = "Marks Field is Required!";
    } else {
        for ($i = 0; $i < count($_POST['id']); $i++) {
            $data = [
                'obtained_marks' => $_POST['obtained_marks'][$i],
                'book_id' => $_POST['book_id'][$i],
                'total_marks' => $_POST['total_marks'],
                'student_id' => $_POST['student_id'],
            ];
            $where = 'id=' . $_POST['id'][$i];
            $update = update('reports', $data, $where);
        }

        echo json_encode($update);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

if (@$_POST['id']) {
    $student = 'student_id=' . $_POST['id'];
    $students = select('reports', '*', $student);
    foreach ($students as $value) {
        $where = 'id=' . $value['id'];
        $insert = delete('reports', $where);
    }
    echo json_encode($insert);
    exit();
};
