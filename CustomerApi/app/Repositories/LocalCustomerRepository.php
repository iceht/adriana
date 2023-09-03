<?php

namespace App\Repositories;

use App\DTO\Customer;
use App\DTO\CustomerBuilder;
use App\Models\CustomerEntity;
use Exception;
use Illuminate\Support\Facades\DB;

class LocalCustomerRepository implements CustomerRepositoryInterface
{

    /**
     *
     * @param int|null $offset Pagination offset
     * @param int|null $limit Pagination limit
     * @return Customer[] All of the customers
     */
    public function getAllCustomers(?int $offset = null, ?int $limit = null): array
    {
        if (!isset($limit) && !isset($offset)) {
            return CustomerEntity::all()->all();
        }
        $customers = CustomerEntity::select('*');
        if (isset($limit)) {
            $customers->limit($limit);
        }
        if (isset($offset)) {
            $customers->offset($offset);
        }
        return $customers->get()->all();
    }

    public function createCustomer(array $customerData): Customer
    {
        DB::beginTransaction();
        try {
            $c = $this->mapCustomerDataArrayToEntity($customerData);
            $c->save();
            DB::commit();
            return $this->mapEntityToDTO($c->refresh());
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function mapCustomerDataArrayToEntity(array $customerData): CustomerEntity
    {
        $c = new  CustomerEntity();
        $c->name = $customerData['name'];
        $c->address = $customerData['address'];
        $c->customer_code = $customerData['customer_code'];
        $c->contract_date = $customerData['contract_date'];
        return $c;
    }

    private function mapEntityToDTO(CustomerEntity $c): Customer
    {
        $builder = new CustomerBuilder();
        return $builder->setId($c->id)
            ->setAddress($c->address)
            ->setContractDate($c->contract_date)
            ->setCustomerCode($c->customer_code)
            ->setName($c->name)
            ->build();
    }

    public function getCustomerById($id): Customer
    {
        return $this->mapEntityToDTO(CustomerEntity::findOrFail($id));
    }

    public function updateCustomerById($id, array $customerData): void
    {
        $customer = CustomerEntity::findOrFail($id);
        $customer = $this->updateCustomerEntityWithCustomerData($customer, $customerData);
        $customer->save();
    }

    private function updateCustomerEntityWithCustomerData(CustomerEntity $customerEntity, array $customerData): CustomerEntity
    {
        if (!empty($customerData['name'])) {
            $customerEntity->name = $customerData['name'];
        }
        if (!empty($customerData['address'])) {
            $customerEntity->address = $customerData['address'];
        }
        if (!empty($customerData['contract_date'])) {
            $customerEntity->contract_date = $customerData['contract_date'];
        }
        if (!empty($customerData['customer_code'])) {
            $customerEntity->customer_code = $customerData['customer_code'];
        }
        return $customerEntity;
    }

    public function deleteCustomerById($id): void
    {
        CustomerEntity::destroy($id);
    }

    public function createMultipleCustomer(array $arrayOfCustomers): array
    {
        $customers = [];
        DB::beginTransaction();
        try {
            foreach ($arrayOfCustomers as $customerData) {
                $c = $this->mapCustomerDataArrayToEntity($customerData);
                $c->save();
                $customers[] = $this->mapEntityToDTO($c->refresh());
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $customers;
    }

}
