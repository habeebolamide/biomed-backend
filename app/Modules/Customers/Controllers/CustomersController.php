<?php

namespace App\Modules\Customers\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customers\Requests\CreateCustomerRequest;
use App\Modules\Customers\Services\CustomerService;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        return (new CustomerService)->allUser($request);
    }

    public function store(CreateCustomerRequest $request)
    {
       return (new CustomerService)->create($request->validated());
    }


    public function search_user($rearch)
    {
        return (new CustomerService)->searchUser($rearch);

    }


    

    public function update(CreateCustomerRequest $request, $id)
    {
       return (new CustomerService)->updateUser($request->validated(), $id);
    }

    
    public function destroy($id)
    {
        return (new CustomerService)->deleteUser($id);
    }

}
