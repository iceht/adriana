<?php

namespace App\Repositories;

use App\DTO\Customer;

interface CustomerRepositoryInterface
{
    public function getAllCustomers(?int $offset = null, ?int $limit = null): array;

    public function createCustomer(array $customerData): Customer;

    public function createMultipleCustomer(array $arrayOfCustomerData): array;

    public function getCustomerById($id): Customer;

    public function updateCustomerById($id, array $customerData): void;

    public function deleteCustomerById($id): void;
}
