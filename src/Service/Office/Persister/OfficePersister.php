<?php

namespace App\Service\Office\Persister;

use App\Dto\OfficeDto;
use App\Entity\Office;
use App\Observer\OfficeNotificationObserverInterface;
use App\Repository\CurrencyRepository;
use App\Repository\OfficeRepository;
use App\Service\Office\Types\Status;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
class OfficePersister
{
    /** @var OfficeNotificationObserverInterface[] */
    private array $observers = [];

    public function __construct(private readonly OfficeRepository $officeRepository, private readonly CurrencyRepository $currencyRepository)
    {
    }

    public function persist(Office $office): void
    {
        $this->officeRepository->save($office, true);
        $this->notify($office);
    }

    public function update(OfficeDto $officeDto, Office $office): void
    {
        $this->loadData($officeDto);

        $office->updateFromDto($officeDto);
        $this->persist($office);
    }

    public function delete(Office $office): void
    {
        $office->changeStatus(Status::DELETED);
        $this->persist($office);
    }

    public function loadData(OfficeDto $officeDto): void
    {
        $officeDto->currency = $this->currencyRepository->findOneBy(['name' => $officeDto->currency]);
    }

    public function subscribe(OfficeNotificationObserverInterface $observer): void
    {
        if (!in_array($observer, $this->observers, true)) {
            $this->observers[] = $observer;
        }
    }

    private function notify(Office $office): void
    {
        foreach ($this->observers as $observer) {
            $observer->onOfficeCreated($office);
        }
    }
}