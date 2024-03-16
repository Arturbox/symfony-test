<?php

namespace App\Controller;

use App\DTO\Calculate\CalculateDTO;
use App\DTO\TransformerDTO;
use App\Exception\RepositoryException;
use App\Exception\ServiceException;
use App\Request\CalculateRequest;
use App\Service\CalculateService\CalculateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
final class CalculateController extends AbstractController
{
    public function __construct(protected CalculateService $calculateService)
    {
    }

    #[Route('/calculate-price', name: 'calculate_price', methods: ['post'])]
    public function calculate(CalculateRequest $request): JsonResponse
    {
        $request->validate();
        try {
            $calculateDTO = TransformerDTO::transform(CalculateDTO::class, ...$request->toArray());

            $price = $this->calculateService->calculatePrice($calculateDTO->productId, $calculateDTO->taxNumber, $calculateDTO->couponCode);

            return $this->json([
                'message' => 'Success',
                'price' => $price

            ]);
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
