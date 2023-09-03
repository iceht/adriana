<?php

namespace App\Repositories;

use App\DTO\Customer;
use App\DTO\CustomerBuilder;
use App\Exceptions\HttpException;
use Illuminate\Support\Facades\Http;

class HttpCustomerRepository implements CustomerRepositoryInterface
{
    private string $URL = 'http://localhost:8000/api';

    public function getAllCustomers(?int $offset = null, ?int $limit = null): array
    {
        $response = Http::accept('application/json')->get("{$this->URL}/customers", ['$offset' => $offset, 'limit' => $limit]);
        if ($response->status() != 200) {
            throw new HttpException($response->status(), $response->body());
        }
        return $response->json();
    }

    public function createCustomer(array $customerData): Customer
    {
        $response = Http::accept('application/json')->post("{$this->URL}/customers", $customerData);
        if ($response->status() != 201) {
            throw new HttpException($response->status(), $response->body());
        }
        return $this->mapJsonResponseToCustomer($response->json());
    }

    public function createMultipleCustomer(array $arrayOfCustomerData): array
    {
        $response = Http::accept('application/json')->post("{$this->URL}/customers", $arrayOfCustomerData);
        if ($response->status() != 201) {
            throw new HttpException($response->status(), $response->body());
        }
        return $response->json();
    }

    public function getCustomerById($id): Customer
    {
        $response = Http::accept('application/json')->get("{$this->URL}/customers/{$id}");
        if ($response->status() != 200) {
            throw new HttpException($response->status(), $response->body());
        }
        return $this->mapJsonResponseToCustomer($response->json());
    }

    public function updateCustomerById($id, array $customerData): void
    {
        $response = Http::accept('application/json')->patch("{$this->URL}/customers/{$id}", $customerData);
        if ($response->status() != 200) {
            throw new HttpException($response->status(), $response->body());
        }
    }

    public function deleteCustomerById($id): void
    {
        $response = Http::accept('application/json')->delete("{$this->URL}/customers/{$id}");
        if ($response->status() != 204) {
            throw new HttpException($response->status(), $response->body());
        }
    }

    private function mapJsonResponseToCustomer(array $c)
    {
        $builder = new CustomerBuilder();
        $builder->setId($c['id'])
            ->setName($c['name'])
            ->setAddress($c['address'])
            ->setContractDateFromString($c['contract_date']);
        if (!empty($c['customer_code'])) {
            $builder->setCustomerCode($c['customer_code']);
        }
        return $builder->build();
    }

}
