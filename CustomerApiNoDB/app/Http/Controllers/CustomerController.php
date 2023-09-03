<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\ListingCustomersRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Repositories\CustomerRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{

    public function __construct(private readonly CustomerRepositoryInterface $customerRepository)
    {
    }

    public function list(ListingCustomersRequest $request): JsonResponse
    {
        return response()->json(
            $this->customerRepository->getAllCustomers($request->get('offset'), $request->get('limit')),
            Response::HTTP_OK);
    }

    public function add(CreateCustomerRequest $request): JsonResponse
    {
        return response()->json($this->customerRepository->createMultipleCustomer($this->checkMalformedJson($request)), Response::HTTP_CREATED);
    }

    public function getById(string $id): JsonResponse
    {
        return response()->json($this->customerRepository->getCustomerById($id), Response::HTTP_OK);

    }

    public function updateById(string $id, UpdateCustomerRequest $request): JsonResponse
    {
        $this->customerRepository->updateCustomerById($id, $this->checkMalformedJson($request));
        return response()->json(null, Response::HTTP_OK);
    }

    public function deleteById(string $id): JsonResponse
    {
        $this->customerRepository->deleteCustomerById($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     *
     * @throws BadRequestException
     */
    private function checkMalformedJson(FormRequest $request)
    {
        if (empty($request->json()->all())) {
            throw new BadRequestException("", 400);
        }
        return $request->json()->all();
    }

}
