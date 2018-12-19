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

    $file = $_FILES['file'] ?? false;
    if (!$file)
    {
        exit_error('File did not upload correctly. Probably too big.');
    }

    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_tmp_path = $file['tmp_name'];
    $file_error_code = $file['error'];


    //Check error on upload
    if ($file_error_code !== UPLOAD_ERR_OK)
    {
        switch ($file_error_code) {
            case UPLOAD_ERR_INI_SIZE || UPLOAD_ERR_FORM_SIZE :
                $message = 'File too big.';
                break;

            case UPLOAD_ERR_PARTIAL :
                $message = 'Upload stop during transfer.';
                break;
            
            case UPLOAD_ERR_CANT_WRITE :
                $message = 'Impossible to write file on server.';
                break;
            
            default :
                $message = 'Unknown error.';
                break;
        }
       
        exit_error($message);
    }


    //Ensure name unicity
    while ($file_with_same_name = get_user_file_by_name($pdo, $user['id'], $file_name))
    {
        $file_name = 'copy-' . $file_name;
    }


    //Generate file uid
    $uid = sha1_file($file_tmp_path) . md5_file($file_tmp_path);
    $new_file_path = '../files/' . $uid;


    //Move file to files dir if not already exist
    if (!file_exists($new_file_path))
    {
        $move_success = move_uploaded_file($file_tmp_path, $new_file_path);
        if (!$move_success)
        {
            exit_error('Impossible to write file in server.');
        }
    }


    $insert_success = insert_file($pdo, $user['id'], $file_name, $uid);
    if (!$insert_success)
    {
        if (!empty($insert_success))
        {
            unlink($new_file_path);
        }

        exit_error('Impossible to insert file in database.');
    }

    exit_success();

