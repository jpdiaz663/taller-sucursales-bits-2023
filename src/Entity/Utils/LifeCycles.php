<?php

namespace App\Entity\Utils;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
#[ORM\HasLifecycleCallbacks]
trait LifeCycles
{

    #[ORM\Column(
        type: "datetime_immutable",
        nullable: true,
        updatable: false,
        options: ['default' => "CURRENT_TIMESTAMP"],
        columnDefinition: 'timestamp DEFAULT CURRENT_TIMESTAMP',
    )]
    public ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: "datetime_immutable", nullable: true)]
    public ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }


    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateDates(): void
    {

        $this->updatedAt = new \DateTimeImmutable();

        if ($this->createdAt === null) {
            $this->createdAt = new \DateTimeImmutable();
        }
    }


    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }


}