<?php

namespace App\Http\Controllers\Main\Profile;

use App\DTO\Main\SaveAddressDTO;
use App\Handler\Command\Main\Address\SaveAddressHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\SaveAddressRequest;
use App\Models\Address;

class AddressBookController extends Controller
{

    private HandlerService $handlerService;
    private SaveAddressDTO $dto;

    public function __construct(HandlerService $handlerService, SaveAddressDTO $dto)
    {
        $this->handlerService = $handlerService;
        $this->dto = $dto;
    }

    public function index()
    {
        
        $addresses = auth()->user()->addresses;
        $url = route('main.profile.user.address.store');
        $countries = config('countries');
        return view('main.pages.profile.user.address.index', compact(
            'addresses', 'url', 'countries'
        ));
    }

    public function create()
    {
        $title = 'Add Address';
        $url = route('main.profile.user.address.store');
        $address = '';
        return view('main.pages.profile.user.address.save_form', compact('url', 'title', 'address'));
    }

    public function store(SaveAddressRequest $request)
    {
       
        $dto = $this->dto->make($request);
        $handler = $this->handlerService->setHandler(new SaveAddressHandler)->getHandler();
        $handler->setDTO($dto)->setModel(new Address)->handle();

        return $this->jsonSuccess('', [
            'url' => route('main.profile.user.address.index')
        ]);
    }

    public function edit(Address $address)
    {
        $url = route('main.profile.user.address.update', ['address' => $address->id]);
        return $this->jsonSuccess('', [
            'address' => $address,
            'url' => $url
        ]);
    }

    public function update(Address $address, SaveAddressRequest $request)
    {
        $dto = $this->dto->make($request);
        $handler = $this->handlerService->setHandler(new SaveAddressHandler)->getHandler();
        $handler->setDTO($dto)->setModel($address)->handle();

        return $this->jsonSuccess('', [
            'url' => route('main.profile.user.address.index')
        ]);
    }


    public function destroy(Address $address)
    {
        try {
            $address->delete();
            return $this->jsonSuccess('Successfully deleted');
        } catch (\Exception $exception) {
            info($exception->getMessage());
            return $this->jsonError('Something is wrong');
        }
    }

}
