<?php

namespace App\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination;
use ApiPlatform\State\ProviderInterface;
use App\Dto\OfficeDto;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
class CurrencyProvider implements ProviderInterface
{
    public function __construct(private ProviderInterface $itemProvider)
    {
    }


    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $office = $this->itemProvider->provide($operation, $uriVariables, $context);

        return OfficeDto::createFromEntity($office);
    }
}