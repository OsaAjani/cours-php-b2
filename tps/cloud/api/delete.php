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

    delete_user_file($pdo, $user['id'], $file_uid);

    //If no other files with this hash, delete file from server
    $file_still_exist = get_file_by_uid ($pdo, $file_uid);
    if (!$file_still_exist)
    {
        unlink('../files/' . $file['uid']);
    }

    exit_success();

