<?php

namespace App\Services\V1;

use App\Models\User;
use App\Repositories\AddressRepository;

class AddressService
{
    public function __construct(protected $addressRepository = null,
        protected $verificationService = null)
    {
        $this->addressRepository = app(AddressRepository::class);
    }

    public function getAddresses()
    {
        return $this->addressRepository
            ->paginateAddresses();
    }

    public function getUserAddresses(User $user)
    {
        return $this->addressRepository
            ->paginateUserAddresses($user);
    }

    public function storeAddresses(array $data, ?User $user)
    {
        if (! empty($user)) {
            $data['user_id'] = $user->id;
        }

        return $this->addressRepository
            ->setData($data)
            ->saveAddress();
    }
}
