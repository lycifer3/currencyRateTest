<?php

namespace App\Controller;

use App\Dto\CurrencyRateDto;
use App\Repository\CurrencyRateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @property CurrencyRateRepository currencyRateRepository
 * @property ValidatorInterface validator
 * @property SerializerInterface serializer
 *
 * @Route("/api", name="api")
 */
class IndexController extends AbstractController
{
    public function __construct(
        ValidatorInterface $validator,
        CurrencyRateRepository $currencyRateRepository,
    )
    {
        $this->validator = $validator;
        $this->currencyRateRepository = $currencyRateRepository;
    }

    /**
     * @Route("/bitcoin-rate", name="bitcoin_rate", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $requestDto = CurrencyRateDto::loadFromRequest($request);
        $errors = $this->validator->validate($requestDto);

        // Здесь уже нагавнякано, по нормальному сделал бы вот так но времени не хватает https://ideneal.medium.com/symfony-4-a-good-way-to-deal-with-exceptions-for-rest-api-afd8b615c923
        $response = ['data' => []];

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $key = str_replace(['[', ']'], '', $error->getPropertyPath());
                $response['errors'][$key][] = $error->getMessage();
            }

            return $this->json($response);
        }

        $rates = $this->currencyRateRepository->findRates($requestDto);
        $response['data'] = $serializer->normalize($rates);

        return $this->json($response);
    }
}