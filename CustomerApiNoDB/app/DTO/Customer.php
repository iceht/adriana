<?php

namespace App\DTO;

use JetBrains\PhpStorm\Internal\TentativeType;
use JsonSerializable;

class Customer implements JsonSerializable
{
    private string $id;
    private string $name;
    private string $address;
    private ?string $customer_code;
    private \DateTime $contract_date;


    public function __construct(CustomerBuilder $builder)
    {
        $this->id = $builder->getId();
        $this->name = $builder->getName();
        $this->address = $builder->getAddress();
        $this->customer_code = $builder->getCustomerCode();
        $this->contract_date = $builder->getContractDate();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCustomerCode(): ?string
    {
        return $this->customer_code;
    }

    /**
     * @return \DateTime
     */
    public function getContractDate(): \DateTime
    {
        return $this->contract_date;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'contract_date' => $this->contract_date->format(\DateTime::RFC3339_EXTENDED),
            'customer_code' => $this->customer_code,
        ];
    }
}
