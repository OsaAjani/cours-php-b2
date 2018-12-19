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

    $files = get_user_files($pdo, $user['id']);
    
    $list_files = [];
    foreach ($files as $file)
    {
        $list_files[] = [
            'name' => $file['name'],
            'uid' => $file['uid'],
            'pubic_uid' => $file['public_uid'],
        ];
    }

    exit_success($list_files);