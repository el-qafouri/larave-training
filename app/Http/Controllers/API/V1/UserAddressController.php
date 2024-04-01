<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AddressResource;
use App\Services\V1\AddressService;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function __construct(protected $addressService = null)
    {
        $this->addressService = app(AddressService::class);
    }

    public function index(Request $request)
    {
        $addresses = $this->addressService->getUserAddresses($request->user());

        return $this->generateResponse(AddressResource::collection($addresses), true);
    }
}
