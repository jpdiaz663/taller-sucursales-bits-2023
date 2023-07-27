<?php

namespace App\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination;
use ApiPlatform\State\ProviderInterface;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
class CurrencyProvider implements ProviderInterface
{
//    public function __construct(private ProviderInterface $itemProvider)
//    {
//    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
//        dd($uriVariables, 'asd');
        // TODO: Implement provide() method.
    }
}