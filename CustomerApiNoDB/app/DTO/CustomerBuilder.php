<?php

namespace App\DTO;

class CustomerBuilder
{
    private string $id;
    private string $name;
    private string $address;
    private ?string $customer_code;
    private \DateTime $contract_date;

    /**
     * @param string $id
     * @return CustomerBuilder
     */
    public function setId(string $id): CustomerBuilder
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $name
     * @return CustomerBuilder
     */
    public function setName(string $name): CustomerBuilder
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $address
     * @return CustomerBuilder
     */
    public function setAddress(string $address): CustomerBuilder
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param ?string $customer_code
     * @return CustomerBuilder
     */
    public function setCustomerCode(?string $customer_code): CustomerBuilder
    {
        $this->customer_code = $customer_code;
        return $this;
    }

    /**
     * @param \DateTime $contract_date
     * @return CustomerBuilder
     */
    public function setContractDate(\DateTime $contract_date): CustomerBuilder
    {
        $this->contract_date = $contract_date;
        return $this;
    }

    /**
     * @param string $contract_date
     * @return CustomerBuilder
     */
    public function setContractDateFromString(string $contract_date): CustomerBuilder
    {
        $this->contract_date = new \DateTime($contract_date);
        return $this;
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

    public function build()
    {
        return new Customer($this);
    }
}
