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

    $public_uid = bin2hex(openssl_random_pseudo_bytes(30));

    set_file_public_uid($pdo, $file['id'], $public_uid);
    
    exit_success();

