<?php

namespace App\Dto;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Tests\Fixtures\Metadata\Get;
use App\Entity\Currency;
use App\Entity\Office;
use App\Validator\IsValidCurrency;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
//#[ApiResource]
class OfficeDto
{

    public function __construct(
    #[Assert\NotBlank]
    public string $code,
    #[Assert\NotBlank]
    public string $description,
    #[Assert\NotBlank]
    public string $address,
    #[Assert\NotBlank]
    public string $rtn,
    #[Assert\NotBlank]
    #[IsValidCurrency]
//    #[ApiProperty(readableLink: false, writableLink: false)]
    public string|Currency $currency
    ) {

    }

    public static function createFromEntity(Office $office): OfficeDto
    {
        return new self(
            $office->getCode(),
            $office->getDescription(),
            $office->getAddress(),
            $office->getRtn(),
            $office->getCurrency()->getSign()
        );
    }

}