<?php
    include '../funcs/datas.php';
    include '../funcs/tools.php';

    use_session();
    
    $pdo = connect_pdo();

    $public_uid = $_GET['public_uid'] ?? false;

    if (!$public_uid)
    {
        exit_error_404();
    }

    $file = get_file_by_public_uid($pdo, $public_uid);

    if (!$file)
    {
        exit_error_404();
    }
    

    $file_path = '../files/' . $file['uid'];
    if (!file_exists($file_path))
    {
        exit_error_404();
    }

    //Send correct header to force download and send file bin with readfile
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file['name'] . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidated');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit();