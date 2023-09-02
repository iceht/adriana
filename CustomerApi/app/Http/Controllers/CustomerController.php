<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\ListingCustomersRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
   public function list(ListingCustomersRequest $request){
   }
   public function add(CreateCustomerRequest $request){
   }
   public function getById(string $id){
   }
   public function updateById(string $id, UpdateCustomerRequest $request){
   }
   public function deleteById(string $id){
   }
}
