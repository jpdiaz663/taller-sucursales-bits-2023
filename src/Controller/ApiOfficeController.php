<?php

namespace App\Controller;

use App\Entity\Office;
use App\Repository\OfficeRepository;
use App\Service\Factory\DtoFactoryInterface;
use App\Service\Factory\FactoryInterface;
use App\Service\Office\Persister\OfficePersister;
use App\Service\Office\Types\Response;
use App\Service\Office\Types\Status;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
#[Route('/api/v2/offices', options: ['expose' => true])]
class ApiOfficeController extends AbstractController
{

    public function __construct(private readonly OfficeRepository $officeRepository)
    {
    }

    #[Route(path: '/{id}', name: 'office_api_create_get_offices', methods: ['GET'])]
    public function getOffices(?Office $id = null): JsonResponse
    {
        if ($id) {
            return $this->json($id);
        }

        return $this->json($this->officeRepository->findBy([
            'status' => Status::ACTIVE->value,
        ]));
    }

    #[Route(path: '/', name: 'office_api_create', methods: ['POST'])]
    public function create(
        Request             $request,
        DtoFactoryInterface $dtoFactory, //Dependency Inversion Principle
        FactoryInterface    $factory, //Dependency Inversion Principle
        OfficePersister     $persister
    ): JsonResponse
    {

       $dto = $dtoFactory->createFromData($request->getPayload()->all());
       $office = $factory->createFromDto($dto);

       $persister->persist($office);

       return $this->json([
           'created' => Response::CREATED,
           'meta' => $office
       ]);

    }

    #[Route(path: '/{id}', name: 'office_api_update', methods: ['POST', 'PUT'])]
    public function update(
        Request $request,
        DtoFactoryInterface $dtoFactory, //Dependency Inversion Principle
        OfficePersister  $persister,
        Office $office
     ): JsonResponse
    {
        $dto = $dtoFactory->createFromData($request->getPayload()->all());
        $persister->update($dto, $office);

        return $this->json([
            'status' => Response::UPDATED,
            'meta' => $office
        ]);
    }

    #[Route(path: '/{id}', name: 'office_api_delete', methods: ['DELETE'])]
    public function delete(Office $office, OfficePersister $persister)
    {
        $persister->delete($office);

        return $this->json([
            'message' => 'Se ha eliminado con exito!',
            'icon' => 'success',
        ]);
    }

    
}