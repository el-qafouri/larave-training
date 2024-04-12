<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\User;
use App\Repositories\Interfaces\CRUDInterface;

class AddressRepository implements CRUDInterface
{
    public function __construct(protected $address = null, protected array $data = [])
    {

    }

    public function getClass()
    {
        return new Address();
    }

    public function setModel($address): self
    {
        $this->address = $address;

        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

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

    public function saveAddress(): Address
    {
        return $this->getQuery()
            ->create([
                'user_id' => $this->data['user_id'],
                'name' => $this->data['name'],
                'address' => $this->data['address'],
                'receiver_name' => $this->data['receiver_name'],
            ]);
    }

    public function updateAddress(int $addressId): bool
    {
        return $this->getQuery()
            ->whereId($addressId)
            ->update([
                'name' => $this->data['name'],
                'address' => $this->data['address'],
                'receiver_name' => $this->data['receiver_name'],
            ]);

    }

    public function deleteAddress(int $addressId): bool
    {
        return $this->getQuery()
            ->whereId($addressId)
            ->delete();

    }
}
