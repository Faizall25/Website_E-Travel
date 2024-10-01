<?php

namespace Controller;

use Repository\UserRepository;
use Service\UserService;

class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService(new UserRepository());
    }

    public function index($params = null)
    {
        echo 'User list';
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        echo json_encode($user);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'nama_lengkap' => $_POST['nama_lengkap'],
                'telpon' => $_POST['telpon'],
                'alamat' => $_POST['alamat'],
                'role' => $_POST['role']
            ];
            $userId = $this->userService->register($data);
            if ($userId) {
                header('Location: index.php?controller=user&action=show&id=' . $userId);
            } else {
                echo 'Registration failed';
            }
        } else {
            include 'view/user/register.php';
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'nama_lengkap' => $_POST['nama_lengkap'],
                'telpon' => $_POST['telpon'],
                'alamat' => $_POST['alamat'],
                'role' => $_POST['role']
            ];
            if ($this->userService->updateUser($id, $data)) {
                header('Location: index.php?controller=user&action=show&id=' . $id);
            } else {
                echo 'Update failed';
            }
        } else {
            $user = $this->userService->getUserById($id);
            include 'view/user/edit.php';
        }
    }

    public function delete($id)
    {
        if ($this->userService->deleteUser($id)) {
            header('Location: index.php?controller=user&action=index');
        } else {
            echo 'Delete failed';
        }
    }

    public function login($username, $password)
    {
        $user = $this->userService->login($username, $password);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            return $user;
        } else {
            return null;
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?controller=user&action=login');
    }
}
