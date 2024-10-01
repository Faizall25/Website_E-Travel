<?php

namespace Service;

use Repository\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        // Hash the password before saving it to the database
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->userRepository->create($data);
    }

    public function login($username, $password)
    {
        try {
            // Lakukan operasi login dengan UserRepository
            $user = $this->userRepository->fetch(['username' => $username]);
            if ($user && $password == $user[0]['password']) {
                return $user[0];
            }
        } catch (\PDOException $e) {
            // Tangani kesalahan jika terjadi
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }

    public function getUserById($id)
    {
        return $this->userRepository->getById($id);
    }

    public function updateUser($id, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
