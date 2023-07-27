<?php

namespace App\Service\Office\Factory;

use App\Dto\OfficeDto;
use App\Entity\Office;
use App\Repository\CurrencyRepository;
use App\Service\Factory\FactoryInterface;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 * Single Responsibility Principle
 * Factory
 */
class Factory implements FactoryInterface
{

    public function __construct(private readonly CurrencyRepository $currencyRepository)
    {
    }

    /**
     * Single Responsibility Principle
     */
    public function createFromDto(object $dto): Office
    {
        //Pattern repository
        $currency = $this->currencyRepository->findOneBy(['name' => $dto->currency]);

        return new Office(
            $dto->code,
            $dto->description,
            $dto->address,
            $dto->rtn,
            $currency,
        );

    }

}