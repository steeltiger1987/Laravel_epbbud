<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 00:11
 */

namespace App\Http\Controllers;

use App\Pic;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerUpdateRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class CustomerController extends Controller
{
    /**
     * @var
     */
    protected $excel;

    /**
     * CustomerController constructor.
     * @param Excel $excel
     */
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function index() {
        $customers = Customer::all();
        $removedCustomers = Customer::withTrashed()->get();
        return view('customer.index', ['customers' => $customers, 'page_title' => 'Customers', 'removedCustomers' => $removedCustomers]);
    }

    public function newCustomer() {
        return view('customer.create',['page_title' => 'Customers']);
    }

    public function storeCustomer(CustomerRequest $request) {
        $customer = new Customer([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'abbreviation' => $request->abbreviation,
            'payment_terms' => $request->payment_terms,
            'default_discount' => $request->default_discount
        ]);
        $customer->save();
        for ($i = 0; $i < count($request->pic_name); $i++){
            Pic::create(['customer_id' => $customer->id, 'name' => $request->pic_name[$i], 'phone' => $request->pic_contact[$i], 'fax' => $request->pic_fax[$i], 'email' => $request->pic_email[$i]]);
        }

        return redirect('customers');
    }

    public function removeCustomer($id) {
        Customer::where('id', $id)->delete();
        return redirect('customers');
    }

    public function viewCustomer($abbreviation) {
        $customer = Customer::where('abbreviation', $abbreviation)->first();
        return view('customer.view', ['customer' => $customer, 'page_title' => 'Customers']);
    }
    public function editCustomer($abbreviation) {
        $customer = Customer::where('abbreviation', $abbreviation)->first();
        return view('customer.edit', ['customer' => $customer, 'page_title' => 'Customers']);
    }

    public function updateCustomer(CustomerUpdateRequest $request) {
        $customer = Customer::where('id', $request->id)->first();
        $customer->company_name = $request->company_name;
        $customer->company_address = $request->company_address;
        $customer->abbreviation = $request->abbreviation;
        $customer->payment_terms = $request->payment_terms;
        $customer->default_discount = $request->default_discount;

        $customer->save();

        Pic::where('customer_id', $customer->id)->delete();
        for ($i = 0; $i < count($request->pic_name); $i++){
            Pic::create(['customer_id' => $customer->id, 'name' => $request->pic_name[$i], 'phone' => $request->pic_contact[$i], 'fax' => $request->pic_fax[$i], 'email' => $request->pic_email[$i]]);
        }

        return redirect('customers');
    }

    public function exportCustomers() {
        $customers = [];
        $cust = Customer::all(['id', 'company_name', 'company_address', 'payment_terms']);
        foreach ($cust as $customer) {
            $pics = Pic::where('customer_id', $customer->id)->get();
            foreach ($pics as $pic) {
                $c = [];
                $c['company_name'] = $customer->company_name;
                $c['company_address'] = $customer->company_address;
                $c['pic'] = !empty($pic) ? $pic->name : '';
                $c['phone'] = !empty($pic) ? $pic->phone : '';
                $c['email'] = !empty($pic) ? $pic->email : '';
                $c['payment_terms'] = $customer->payment_terms;
                array_push($customers, $c);
            }
        }

        $this->excel->create('Customers', function($excel) use ($customers) {
            $excel->sheet('Customers', function($sheet) use ($customers) {

                $sheet->appendRow()->fromModel($customers, null, 'A1', null, null);
                $sheet->prependRow(1, array(
                    'Company Name', 'Company Address', 'PIC', 'Phone Number', 'Email Address', 'Payment Terms'
                ));

                $sheet->setFontSize(15);
                $sheet->setBorder('A1:F1', 'thin');

                $sheet->cells('A1:F1000', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('middle');
                    $cells->setFontSize(15);
                });
            });
        })->export('xlsx');
    }

    public function restoreCustomer($id)
    {
        $customer = Customer::withTrashed()->find($id);
        $customer->deleted_at = null;
        $customer->save();

        return redirect()->back();
    }
}