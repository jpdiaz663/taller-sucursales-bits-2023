<?php

namespace App\Entity\Utils;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
trait LifeCycles
{
    #[ORM\Embedded(class: LifeCycleDates::class, columnPrefix: false)]
    #[ApiProperty(writable: false)]
    protected LifeCycleDates $dates;

    public function dates(): LifeCycleDates
    {
        return $this->dates;
    }

}