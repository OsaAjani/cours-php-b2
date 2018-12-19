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

    $file_id = $_GET['file_id'] ?? false;
    if (!$file_id)
    {
        header('Location: ./admin.php');
        exit();
    }


    $file = get_file($pdo, $file_id);
    if (!$file)
    {
        header('Location: ./admin.php');
        exit();
    }


    delete_file($pdo, $file_id);


    //If no other files with this hash, delete file from server
    $file_still_exist = get_file_by_uid ($pdo, $file['uid']);
    if (!$file_still_exist)
    {
        unlink('./files/' . $file['uid']);
    }


    header('Location: ./user_public_files.php?user_id=' . $file['user_id']);
    exit();

