<?php

namespace App\Service\Office\Factory;

use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\OfficeDto;
use App\Service\Factory\DtoFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
// Open/Closed Principle depende de la interface ya hace que cada objeo que lo implemente haga sus propias acciones en cada metodo.
class DtoFactory implements DtoFactoryInterface
{

    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function createFromRequest(Request $request): OfficeDto
    {
        return $this->createFromData(json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR));
    }

    public function createFromData(mixed $json_decode): OfficeDto
    {
        //DTO patterns
        $dto = new OfficeDto(
            $json_decode['code'],
            $json_decode['description'],
            $json_decode['address'],
            $json_decode['rtn'],
            $json_decode['currency']
        );

        $this->validator->validate($dto);

        return $dto;
    }

}