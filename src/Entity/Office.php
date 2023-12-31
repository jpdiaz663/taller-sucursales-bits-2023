<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Dto\OfficeDto;
use App\Entity\Utils\LifeCycles;
use App\Processor\OfficeDataProcessor;
use App\Provider\CurrencyProvider;
use App\Repository\OfficeRepository;
use App\Service\Office\Types\Status;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OfficeRepository::class)]
#[Post(input: OfficeDto::class, processor: OfficeDataProcessor::class)]
#[Get(output: OfficeDto::class, provider: CurrencyProvider::class)]
#[ORM\HasLifecycleCallbacks()]
class Office
{
    use LifeCycles;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
//    #[ApiProperty(identifier: false)]
    private ?int $id;

    #[ORM\Column(length: 255)]
    private string $code;

    #[ORM\Column(length: 255)]
    private string $description ;

    #[ORM\Column(length: 255)]
    private string $address;

    #[ORM\Column(length: 255)]
    #[ApiFilter(SearchFilter::class, strategy: 'ipartial')]
    private string $rtn;

//    #[Groups('currency')]
//    #[ApiProperty(readableLink: false, writableLink: false)]
    #[ORM\ManyToOne(inversedBy: 'offices')]
    #[ORM\JoinColumn(nullable: false)]
    private Currency $currency;

    #[ORM\Column(type: 'string')]
    private Status|string $status;

    // Singleton
    public function __construct(string $code, string $description, string $address, string $rtn, Currency $currency)
    {
        $this->code = $code;
        $this->description = $description;
        $this->address = $address;
        $this->rtn = $rtn;
        $this->currency = $currency;
        $this->status = Status::ACTIVE->value;
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getRtn(): ?string
    {
        return $this->rtn;
    }

    public function setRtn(string $rtn): self
    {
        $this->rtn = $rtn;

        return $this;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function updateFromDto(OfficeDto $officeDto): void
    {
        $this->code = $officeDto->code;
        $this->description = $officeDto->description;
        $this->address = $officeDto->address;
        $this->rtn = $officeDto->rtn;
        $this->currency = $officeDto->currency;
    }


    public function changeStatus(Status $status): void
    {
        if ($this->status === $status) {
            return;
        }

        $this->status = $status->value;
    }


    public function getStatus(): Status|string
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

}
