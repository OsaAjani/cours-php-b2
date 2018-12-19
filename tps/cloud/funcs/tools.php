<?php

    function use_session ()
    {
        session_name('cloud');
        session_start();
    }
    

    function is_authentified ($pdo)
    {
        if (!isset($_GET['api_key']) && !isset($_SESSION['user']))
        {
            return false;
        }

        if (isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        }

        $user = get_user_by_api_key($pdo, $_GET['api_key']);
        if (!$user)
        {
            return false;
        }

        return $user;
    }


    function exit_error ($message, $code = 400)
    {
        check_and_try_redirect();

        http_response_code($code);
        echo json_encode(['success' => false, "message" => $message]);
        exit();
    }


    function exit_success ($data = null)
    {
        check_and_try_redirect();

        echo json_encode(['success' => true, 'data' => $data]);
        exit();
    }


    function exit_error_not_connected ()
    {
        exit_error('Invalid API key.', 401);
    }


    function exit_error_404 ()
    {
        exit_error('This resource does not exist.', 404);
    }


    function check_and_try_redirect ()
    {
        $redirect = $_GET['redirect'] ?? false;
        if ($redirect)
        {
            header('Location: ../home.php');
        }
    }
