<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\User;
use App\Repositories\Interfaces\CRUDInterface;

class AddressRepository implements CRUDInterface
{
    public function __construct(protected $address = null)
    {

    }

    public function getClass()
    {
        return new Address();
    }

    public function setModel($user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getQuery()
    {
        return Address::query();
    }

    public function paginateAddresses()
    {
        return $this->getQuery()
            ->paginate();
    }

    public function paginateUserAddresses(User $user)
    {
        return $this->getQuery()
            ->where('user_id', $user->id)
            ->paginate();
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
