<?php

namespace Tests\Unit\Services\V1;

use App\Models\Address;
use App\Services\V1\AddressService;
use Tests\TestCase;

class AddressServiceTest extends TestCase
{
    public function test_that_get_addresses_returned_null_if_there_is_no_address()
    {
        $data = app(AddressService::class)
            ->getAddresses();

        $this->assertEquals($data->count(), 0);
    }

    public function test_that_get_addresses_returned_data_if_there_is_exists_an_address()
    {
        Address::factory()->create();
        $data = app(AddressService::class)
            ->getAddresses();

        $this->assertEquals($data->count(), 1);
    }
}
