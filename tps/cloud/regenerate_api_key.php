<?php
    include './funcs/datas.php';
    include './funcs/tools.php';
    
    use_session();

    $pdo = connect_pdo();

    $user = is_authentified($pdo);

    if (!$user)
    {
        header('Location: ./login.php');
        exit();
    }

    $new_api_key = bin2hex(openssl_random_pseudo_bytes(30));
    set_user_api_key($pdo, $user['id'], $new_api_key);

    $user = get_user($pdo, $user['id']);
    $_SESSION['user'] = $user;

    header('Location: ./account.php');
    exit();
