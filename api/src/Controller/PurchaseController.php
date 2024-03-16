<?php

namespace App\Controller;

use App\DTO\Calculate\CalculateDTO;
use App\DTO\Purchase\PurchaseDTO;
use App\DTO\TransformerDTO;
use App\Exception\RepositoryException;
use App\Exception\ServiceException;
use App\Request\PurchaseRequest;
use App\Service\CalculateService\CalculateService;
use App\Service\PurchaseService\PurchaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
final class PurchaseController extends AbstractController
{
    public function __construct(protected PurchaseService $purchaseService, protected CalculateService $calculateService)
    {
    }

    #[Route('/purchase', name: 'app_purchase', methods: ['post'])]
    public function create(PurchaseRequest $request): JsonResponse
    {
        try {
            $request->validate();
            $calculateDTO = TransformerDTO::transform(CalculateDTO::class, ...$request->toArray());
            $purchaseDTO = TransformerDTO::transform(PurchaseDTO::class, ...$request->toArray());

            $price = $this->calculateService->calculatePrice($calculateDTO->productId, $calculateDTO->taxNumber, $calculateDTO->couponCode);
            if ($this->purchaseService->pay($purchaseDTO->type->value, $price)) {
                return $this->json([
                    'message' => 'Success',
                ]);
            }
        } catch (RepositoryException|ServiceException $e) {
            return $this->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable) {
            return $this->json([
                'message' => 'Internal Error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
