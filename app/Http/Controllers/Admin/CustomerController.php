<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index(Customer $customer)
    {
        $customers = Customer::orderBy('id', 'desc')
            ->with('user')
            ->filter(request()->only('role', 'search'))
            ->paginate()
            ->withQueryString()
            ->through(function ($customer) {
                return [
                    'id' => $customer->id,
                    'company' => $customer->company_name,
                    'company_org_nr' => $customer->company_org_nr,
                    'name' => $customer->user->name,
                    'email' => $customer->user->email,
                    'role' => $customer->role === 'new' ? 'Ny' : 'Odlare',
                    'updated_time_ago' => $customer->updated_time_ago
                ];
            });

        $filters = request()->all('role', 'search', 'page');

        return Inertia::render('Admin/Customers/Index', compact('customers', 'customer', 'filters'));
    }

    public function show(Customer $customer)
    {
        $customer->load('user', 'fieldParts', 'certifications');

        inertia()->modal('Admin/Customers/Show');

        return $this->index($customer);
    }

    public function destroy(Request $request, Customer $customer)
    {
        $customer->user()->delete();
        $customer->fieldParts()->delete();

        $customer->delete();

        $request->session()->flash('flash.banner', 'Odlaren är nu raderad.');

        return redirect()->route('admin.customers.index');
    }
}
