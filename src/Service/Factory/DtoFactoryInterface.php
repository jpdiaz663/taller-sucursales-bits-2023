<?php

namespace App\Service\Factory;

use Symfony\Component\HttpFoundation\Request;

//Liskov Substitution Principle
interface DtoFactoryInterface
{
    public function createFromData(array $json_decode);
    public function createFromRequest(Request $request);
}