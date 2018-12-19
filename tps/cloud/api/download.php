<?php
    include '../funcs/datas.php';
    include '../funcs/tools.php';

    use_session();

    $pdo = connect_pdo();

    $user = is_authentified($pdo);
    if (!$user)
    {
        exit_error_not_connected();
    }

    $file_uid = $_GET['uid'] ?? false;

    if (!$file_uid)
    {
        exit_error_404();
    }

    $file = get_user_file($pdo, $user['id'], $file_uid);

    if (!$file)
    {
        exit_error_404();
    }
    
    $file_path = '../files/' . $file['uid'];

    if (!file_exists($file_path))
    {
        exit_error_404();
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file['name'] . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidated');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit();