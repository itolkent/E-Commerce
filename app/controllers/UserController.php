<?php

class UserController extends Controller
{
    public function register()
    {
        $this->view('auth/register');
    }

    public function store()
    {
        $userModel = new User();

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ];

        // Check if email already exists
        if ($userModel->findByEmail($data['email'])) {
            $_SESSION['error'] = "Email already registered.";
            $this->redirect(BASE_URL . 'register');
        }

        $userModel->create($data);

        $_SESSION['success'] = "Account created successfully. Please log in.";
        $this->redirect(BASE_URL . 'login');
    }
    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect(BASE_URL . 'login');
        }

        $userModel = new User();
        $user = $userModel->find($_SESSION['user']['id']);

        $this->view('auth/profile', [
            'user' => $user
        ]);
    }

}