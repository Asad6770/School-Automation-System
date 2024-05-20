<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = '../../assets/upload/' . $file;

    // Allowed file extensions
    $allowedExtensions = ['mp4', 'docx', 'doc', 'pdf'];

    // Get the file extension
    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

    // Check if the file extension is allowed
    if (in_array(strtolower($fileExtension), $allowedExtensions)) {
        if (file_exists($filePath)) {
            // Set headers based on file type
            switch ($fileExtension) {
                case 'mp4':
                    header('Content-Type: video/mp4');
                    break;
                case 'docx':
                    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                    break;
                case 'doc':
                    header('Content-Type: application/msword');
                    break;
                case 'pdf':
                    header('Content-Type: application/pdf');
                    break;
            }

            header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            // Read the file
            readfile($filePath);
            exit;
        } else {
            echo "File does not exist.";
        }
    } else {
        echo "File type not allowed.";
    }
} else {
    echo "No file specified.";
}
?>
