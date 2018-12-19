<?php
    include './funcs/datas.php';
    include './funcs/tools.php';

    use_session();
    
    $pdo = connect_pdo();

    $user = is_authentified($pdo);
    if (!$user || !$user['admin'])
    {
        header('Location: ./admin.php');
        exit();
    }

    $user_id = $_GET['user_id'] ?? false;
    if (!$user_id)
    {
        header('Location: ./admin.php');
        exit();
    }


    $target_user = get_user($pdo, $user_id);
    if (!$target_user)
    {
        header('Location: ./admin.php');
        exit();
    }

    //Delete user files
    $files = get_user_files($pdo, $target_user['id']);
    foreach ($files as $file)
    {
        delete_user_file($pdo, $target_user['id'], $file['uid']);

        //If no other files with this hash, delete file from server
        $file_still_exist = get_file_by_uid ($pdo, $file['uid']);
        if (!$file_still_exist)
        {
            unlink('./files/' . $file['uid']);
        }
    }


    delete_user($pdo, $target_user['id']);


    header('Location: ./admin.php');
    exit();

