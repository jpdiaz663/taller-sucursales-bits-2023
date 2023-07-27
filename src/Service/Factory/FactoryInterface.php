<?php

namespace App\Service\Factory;

use App\Dto\OfficeDto;

//Liskov Substitution Principle
interface FactoryInterface
{
    public function createFromDto(object $dto);

}