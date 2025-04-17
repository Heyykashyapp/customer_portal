<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{


    /**
     * Display a listing of the customers.
     *
     * @group Customers
     * 
     * @response 200 [
     *   {
     *     "id": 1,
     *     "first_name": "Prashant",
     *     "last_name": "Kumar",
     *     "email": "kashyapp722@gmail.com",
     *     "dob": "1997-01-01",
     *     "age": 27,
     *     "created_at": "2025-04-17T10:00:00.000000Z",
     *     "updated_at": "2025-04-17T10:00:00.000000Z"
     *   }
     * ]
     */

    public function index()
    {
        return Customer::all();
    }

       /**
     * Store a newly created customer.
     *
     * @group Customers
     * 
     * @bodyParam first_name string required The first name of the customer. Example: John
     * @bodyParam last_name string required The last name of the customer. Example: Doe
     * @bodyParam email string required The email of the customer. Example: john.doe@example.com
     * @bodyParam dob date required The date of birth of the customer. Example: 1985-01-01
     * @bodyParam age integer required The age of the customer. Example: 36
     * 
     * @response 201 {
     *   "message": "Customer created successfully!",
     *   "customer": {
     *     "id": 1,
     *     "first_name": "Prashant",
     *     "last_name": "Kumar",
     *     "email": "kashyapp722@gmail.com",
     *     "dob": "1997-01-01",
     *     "age": 27,
     *     "created_at": "2025-04-17T10:00:00.000000Z",
     *     "updated_at": "2025-04-17T10:00:00.000000Z"
     *   }
     * }
     */
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:customers,email',
            'dob' => 'required|date',
            'age' => 'required|integer',
        ]);

       
        $customer = Customer::create($validated);

        return response()->json($customer, 201);
    }


 /**
     * Display the specified customer.
     *
     * @group Customers
     *
     * @response 200 {
     *   "id": 1,
     *   "first_name": "Prashant",
     *   "last_name": "kumar",
     *   "email": "kashyapp722@gmail.com",
     *   "dob": "1985-01-01",
     *   "age": 36,
     *   "created_at": "2025-04-17T10:00:00.000000Z",
     *   "updated_at": "2025-04-17T10:00:00.000000Z"
     * }
     */

    public function show($id)
    {
        return Customer::findOrFail($id);
    }
    
      /**
     * Update the specified customer.
     *
     * @group Customers
     *
     * @bodyParam first_name string required The first name of the customer. Example: Jane
     * @bodyParam last_name string required The last name of the customer. Example: Smith
     * @bodyParam email string required The email of the customer. Example: kashyapp722@gmail.com
     * @bodyParam dob date required The date of birth of the customer. Example: 1990-05-15
     * @bodyParam age integer required The age of the customer. Example: 31
     * 
     * @response 200 {
     *   "message": "Customer updated"
     * }
     */

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return response()->json($customer, 200);
    }


     /**
     * Remove the specified customer.
     *
     * @group Customers
     * 
     * @response 200 {
     *   "message": "Customer deleted"
     * }
     */



    public function destroy($id)
    {
        Customer::destroy($id);
        return response()->json(['message' => 'Customer deleted']);
    }
}
