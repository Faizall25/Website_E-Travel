<?php

namespace Model;

class UserModel
{
    public ?string $name = '';
    public ?string $email = '';
    public ?string $password = '';
    public ?string $username = '';
    public ?string $role = '';
    public ?string $telpon = '';
    public ?string $alamat = '';

    public function __construct(?string $name, ?string $email, ?string $password, ?string $username, ?string $role, ?string $telpon, ?string $alamat)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->role = $telpon;
        $this->alamat = $alamat;
    }

    public function toArray()
    {
        return [
            'nama_lengkap' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'username' => $this->username,
            'role' => $this->role,
            'alamat' => $this->alamat
        ];
    }
}
