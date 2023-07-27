<?php

namespace App\Entity\Utils;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
#[ORM\HasLifecycleCallbacks]
class LifeCycleDates
{
    #[ORM\Column(
        type: "datetime_immutable",
        nullable: true,
        updatable: false,
        options: ['default' => "CURRENT_TIMESTAMP"],
        columnDefinition: 'timestamp DEFAULT CURRENT_TIMESTAMP',
    )]
    protected \DateTimeImmutable $createdAt;

    #[ORM\Column(type: "datetime_immutable", nullable: true)]
    protected ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[ORM\PrePersist]
    public function createAt(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

}