<?php

class AuthController extends Controller
{

    public function login(): void
    {
        $this->view('auth/login', [
            'csrf' => $this->csrfToken(),
        ]);
    }

    public function loginPost(): void
    {
        $this->verifyCsrf();
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (!$user || !$userModel->verifyPassword($user, $password)) {
            $this->view('auth/login', [
                'error' => 'Invalid credentials',
                'csrf' => $this->csrfToken(),
            ]);
            return;
        }

        // Store session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['is_admin'] = ($user['role'] === 'admin');

        $this->redirect(BASE_URL);
    }

    public function register(): void
    {
        $this->view('auth/register', [
            'csrf' => $this->csrfToken(),
        ]);
    }

    public function registerPost(): void
    {
        $this->verifyCsrf();

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $name = trim($_POST['name'] ?? '');

        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            $this->view('auth/register', [
                'error' => 'Email already registered',
                'csrf' => $this->csrfToken(),
            ]);
            return;
        }

        $userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        $this->redirect(BASE_URL . 'login');
    }
    public function logout(): void
    {
        session_destroy();
        $this->redirect(BASE_URL);
    }

    public function profile(): void
    {
        $this->requireLogin();

        $userModel = new User();
        $user = $userModel->getById($_SESSION['user_id']);

        $this->view('auth/profile', [
            'user' => $user,
            'csrf' => $this->csrfToken(),
        ]);
    }

    public function profilePost(): void
    {
        $this->verifyCsrf();
        $this->requireLogin();
        $this->redirect(BASE_URL . 'profile');
    }

    // Unified login check
    protected function requireLogin(): void
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect(BASE_URL . 'login');
        }
    }


    public function editProfile()
    {
        $this->requireLogin();

        $userModel = new User();
        $user = $userModel->find($_SESSION['user_id']);

        $this->view('auth/profile_edit', [
            'user' => $user,
            'csrf' => $this->csrfToken()
        ]);
    }

    public function editProfilePost()
    {
        $this->verifyCsrf();
        $this->requireLogin();

        $userModel = new User();

        $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
        ];

        if (!empty($_POST['password'])) {
            $data['password_hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        $userModel->update($_SESSION['user_id'], $data);

        $this->redirect(BASE_URL . 'profile');
    }
    public function updateAvatar()
    {
        $this->verifyCsrf();

        if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = "Failed to upload avatar.";
            $this->redirect(BASE_URL . 'profile');
            return;
        }

        $userModel = new User();
        $user = $userModel->find($_SESSION['user_id']);

        $uploadDir = __DIR__ . '/../../public/assets/uploads/avatars/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $filename = 'avatar_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;

        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $filename);

        if ($user['avatar'] !== 'default-avatar.png') {
            $oldPath = $uploadDir . $user['avatar'];
            if (file_exists($oldPath))
                unlink($oldPath);
        }

        $userModel->update($_SESSION['user_id'], ['avatar' => $filename]);

        $_SESSION['success'] = "Avatar updated successfully.";
        $this->redirect(BASE_URL . 'profile');
    }
}
