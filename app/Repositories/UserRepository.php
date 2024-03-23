<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\CRUDInterface;

class UserRepository implements CRUDInterface
{
    public function __construct(protected $user = null)
    {

    }

    public function getClass()
    {
        return new User();
    }

    public function setModel($user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getQuery()
    {
        return User::query();
    }

    public function findByMobile(string $mobile)
    {
        return $this->findByValue('mobile', $mobile);
    }

    public function findByName(string $name)
    {
        return $this->findByValue('name', $name);
    }

    public function findByValue(string $column, string $value)
    {
        return $this->getQuery()
            ->firstWhere($column, $value);
    }

    public function createUser(array $data): User
    {
        return $this->getQuery()
            ->create([
                'mobile' => $data['mobile'],
            ]);
    }

    public function setVerificationTime($time)
    {
        $this->user->update([
            'email_verified_at' => $time,
        ]);
    }
}
