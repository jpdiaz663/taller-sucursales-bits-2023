<?php

namespace App\Dto;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Tests\Fixtures\Metadata\Get;
use App\Validator\IsValidCurrency;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
#[Get]
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

}