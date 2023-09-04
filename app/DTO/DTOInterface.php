<?php


namespace App\DTO;


use Illuminate\Foundation\Http\FormRequest;

interface DTOInterface
{

    public function make(FormRequest $request);
}
