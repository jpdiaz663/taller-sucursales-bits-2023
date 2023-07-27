<?php

namespace App\Dto;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Tests\Fixtures\Metadata\Get;
use App\Entity\Office;
use App\Validator\IsValidCurrency;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
//#[ApiResource]
final class OfficeDto
{
    #[Assert\NotBlank]
    public string $code;

    #[Assert\NotBlank]
    public string $description;

    #[Assert\NotBlank]
    public string $address;

    #[Assert\NotBlank]
    public string $rtn;

    #[Assert\NotBlank]
    #[IsValidCurrency]
//    #[ApiProperty(readableLink: false, writableLink: false)]
    public string $currency;

    public static function createFromEntity(Office $office): OfficeDto
    {
        $dto = new self();
        $dto->code = $office->getCode();
        $dto->description = $office->getDescription();
        $dto->address =  $office->getAddress();
        $dto->rtn = $office->getRtn();
        $dto->currency = $office->getCurrency()->getSign();
        return $dto;
    }
}