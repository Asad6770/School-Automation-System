<?php
require_once '../include/function.php';
session_start();

if (@$_POST["type"] == "create") {
    for ($i = 0; $i < count($_POST['selected_book_id']); $i++) {
        $data = [
            'book_id ' => $_POST['selected_book_id'][$i],
            'class_id ' => $_POST['class_id'],
            'student_id ' => $_SESSION['id'],
        ];
        $insert = insert('course_selection', $data);
    }
    echo json_encode($insert);
}


if (@$_POST["type"] == "edit") {
    $course = select('course_selection', '*', 'student_id=' . $_SESSION['id']);

    foreach ($course as $value) {

        $where = 'id=' . $value['id'];
        $delete = delete('course_selection', $where);
    }

    for ($i = 0; $i < count($_POST['selected_book_id']); $i++) {
        $data = [
            'book_id ' => $_POST['selected_book_id'][$i],
            'class_id ' => $_POST['class_id'],
            'student_id ' => $_SESSION['id'],
        ];

        $insert = insert('course_selection', $data);
    }
    echo json_encode($insert);
}
