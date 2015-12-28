<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 00:11
 */

namespace App\Http\Controllers;


use App\Customer;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{

    public function index() {
        $customers = Customer::all();
        return view('customer.index', ['customers' => $customers]);
    }

    public function newCustomer() {
        return view('customer.create');
    }

    public function storeCustomer(CustomerRequest $request) {
        $customer = Customer::where('company_name', $request->company_name)->first();
        if($customer){
            $customer->company_name = $request->company_name;
            $customer->pic_name = $request->pic_name;
            $customer->pic_email = $request->pic_email;
            $customer->pic_contact = $request->pic_contact;
            $customer->website = $request->website;

            $customer->save();
        }else{
            $customer = new Customer([
                'company_name' => $request->company_name,
                'pic_name' => $request->pic_name,
                'pic_email' => $request->pic_email,
                'pic_contact' => $request->pic_contact,
                'website' => $request->website
            ]);

            $customer->save();
        }
        return redirect('customers');
    }

    public function removeCustomer($id) {
        Customer::where('id', $id)->delete();
        return redirect('customers');
    }

    public function editCustomer($id) {
        $customer = Customer::where('id', $id)->first();
        return view('customer.edit', ['customer' => $customer]);
    }

    public function updateCustomer(CustomerRequest $request) {
        $customer = Customer::where('id', $request->id)->first();
        $customer->company_name = $request->company_name;
        $customer->pic_name = $request->pic_name;
        $customer->pic_email = $request->pic_email;
        $customer->pic_contact = $request->pic_contact;
        $customer->website = $request->website;

        $customer->save();

        return redirect('customers');
    }

}