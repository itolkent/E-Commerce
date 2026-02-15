<?php

class AdminUserController extends Controller
{
    public function index()
    {
        $userModel = new User();
        $users = $userModel->all();

        $this->view('admin/users/index', [
            'users' => $users
        ]);
    }

    public function userinfo($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user) {
            // user not found → show 404 or redirect
            $this->view('admin/users/not_found', [
                'message' => "User not found"
            ]);
            return;
        }

        $this->view('admin/users/userinfo', [
            'user' => $user
        ]);
    }
    public function edit($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);

        $this->view('admin/users/edit', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $userModel = new User();

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email']
        ];

        $userModel->update($id, $data);

        $this->redirect(BASE_URL . "admin/users/$id");
    }

    public function delete($id)
    {
        $userModel = new User();
        $userModel->delete($id);

        $this->redirect(BASE_URL . "admin/users");
    }
    private function requireAdmin(): void
    {
        if (empty($_SESSION['is_admin'])) {
            $this->redirect(BASE_URL);
        }
    }
    public function updateRole($id)
    {
        $this->requireAdmin();

        $newRole = $_POST['role'] ?? null;

        if (!in_array($newRole, ['user', 'admin'])) {
            $this->redirect(BASE_URL . "admin/users/$id");
            return;
        }

        $userModel = new User();
        $userModel->updateRole($id, $newRole);

        $this->redirect(BASE_URL . "admin/users/$id");
    }
}