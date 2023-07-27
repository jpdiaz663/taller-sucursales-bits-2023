<?php

namespace App\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\OfficeDto;
use App\Entity\Office;
use App\Repository\CurrencyRepository;
use App\Repository\OfficeRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class OfficeDataProcessor implements ProcessorInterface
{
    public function __construct(private readonly CurrencyRepository $currencyRepository, private readonly OfficeRepository $officeRepository)
    {
    }

    /**
     * @param OfficeDto $data
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $currency =  $this->currencyRepository->findOneBy([
            'name' => $data->currency
        ]);

        if (!$currency) {
            throw new NotFoundHttpException();
        }

        $office = new Office(
            $data->code,
            $data->description,
            $data->address,
            $data->rtn,
            $currency
        );

        $this->officeRepository->save($office, true);

        return $data;
    }


}
