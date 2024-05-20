<?php
require_once '../../include/function.php';
session_start();

if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    $q = "SELECT student.*, class.name as class_name FROM student INNER JOIN class ON student.class_id = class.id 
    WHERE class_id = " . $class_id . "";
    $data = query($q);
    if (count($data) > 0) {
        $index = 0;
        foreach ($data as $value) {
            $total_days = "SELECT COUNT(*) AS student_count FROM attendance WHERE student_id =" . $value['id'] . "";
            $total_days = query($total_days);
            $totalWorkingDays = $total_days[0]['student_count'];

            $total_present = "SELECT COUNT(*) AS student_present FROM attendance WHERE student_id =" . $value['id'] . " AND attendance_status = 'present'";
            $total_present = query($total_present);
            $totalPresentDays = $total_present[0]['student_present'];
            if ($totalWorkingDays && $totalPresentDays > 0) {
                $percentage =  ($totalPresentDays / $totalWorkingDays) * 100;
            } else {
                $percentage = '0';
            }
            $index += 1;
            @$output .= '<tr class="text-capitalize">
                            <td>' . $index . '</td>
                            <td>' . $value['fullname'] . '</td>
                            <td class="text-uppercase">' . $value['username'] . '</td>
                            <td>Class ' . $value['class_name'] . '</td>
                            <td>' . $percentage . ' %</td>
                        </tr>';
        }
    } else {
        $output = '<tr><td colspan="6">No data available in table</td></tr>';
    }
    echo $output;
}


if (@$_POST['type'] == 'take-attendance') {
    $errors = [];
    $check = null;
    if (!empty($_POST['class_id']) && !empty($_POST['book_id'])) {
        $check = select('attendance', '*', 'class_id=' . $_POST['class_id'] . ' AND book_id=' . $_POST['book_id']);
    } else {
        $errors['book_id'] = "Book is Required!";
    }

    if ($check == null) {
        foreach ($_POST['attendance_status'] as $key => $student_id) {
            if (empty($_POST['attendance_status'][$key])) {
                $errors['attendance_status_' . $key . ''] = "Status is required!";
            }
        }
        if (empty($_POST['attendance_date'])) {
            $errors['attendance_date'] = "Date is Required!";
        } else {
            for ($i = 0; $i < count($_POST['student_id']); $i++) {
                $data = [
                    'student_id' => $_POST['student_id'][$i],
                    'class_id' => $_POST['class_id'],
                    'book_id' => $_POST['book_id'],
                    'teacher_id' => $_SESSION['id'],
                    'attendance_date' => $_POST['attendance_date'],
                    'attendance_status' => $_POST['attendance_status'][$i],
                ];
                $insert = insert('attendance', $data);
            }
            echo json_encode($insert);
            exit();
        }
    } else {
        $errors['attendance'] = "Attendance for the selected Class and Book has already been recorded.";
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

