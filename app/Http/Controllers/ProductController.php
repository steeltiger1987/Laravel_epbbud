<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 00:11
 */

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Filesystem\Factory as StorageFactory;

class ProductController extends Controller
{
    /**
     * @var
     */
    protected $excel;

    /**
     * @var StorageFactory
     */
    protected $storage;

    /**
     * ProductController constructor.
     * @param Excel $excel
     * @param StorageFactory $storage
     */
    public function __construct(Excel $excel, StorageFactory $storage)
    {
        $products = Product::distinct()->get(['type']);
        $this->excel = $excel;
        $this->storage = $storage;

        view()->share(['types' =>$products]);
    }
    public function index() {
        $products = Product::all();
        $removedProducts = Product::withTrashed()->get();
        
        return view('product.index', ['products' => $products, 'page_title' => 'Products', 'removedProducts' => $removedProducts]);
    }
    
    public function restore($id) {
        
        Product::where('code', $id)->restore();
        
        return redirect('products');
    }

    public function newProduct() {
        return view('product.create', ['page_title' => 'Products']);
    }

    public function storeProduct(ProductRequest $request) {

        $product = Product::create([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'color' => $request->get('color'),
            'quantity' => $request->get('quantity'),
            'code' => $request->get('code'),
            'description' => $request->get('description'),
            'd13' => $request->get('d13'),
            'd46' => $request->get('d46'),
            'd6' => $request->get('d6')
        ]);
        if($request->file('image') != null) {
            $fileName = str_random(40);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fullName = $fileName . '.' . $extension;
            $this->storage->disk('local')->put($fullName, file_get_contents($request->file('image')->getRealPath()));

            $product->image = $fullName;

            $product->save();
        }

        return redirect('products/view/' . $product->code)->with('message', 'Product successfully created');
    }

    public function removeProduct($id) {
        Product::where('id', $id)->delete();
        
        return redirect('products')->with('message', 'Product successfully deleted');
    }

    public function editProduct($code) {
        $product = Product::where('code', $code)->first();
        
        return view('product.edit', ['product' => $product, 'page_title' => 'Products']);
    }

    public function viewProduct($code) {
        $product = Product::where('code', $code)->first();
        return view('product.view', ['product' => $product, 'page_title' => 'Products']);
    }

    public function updateProduct(ProductUpdateRequest $request) {
        $product = Product::where('id', $request->get('id'))->first();
        $product->type = $request->get('type');
        $product->name = $request->get('name');
        $product->color = $request->get('color');
        $product->quantity = $request->get('quantity');
        $product->code = $request->get('code');
        $product->description = $request->get('description');
        $product->d13 = $request->get('d13');
        $product->d46 = $request->get('d46');
        $product->d6 = $request->get('d6');

        if($request->file('image') != null) {
            $fileName = str_random(40);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fullName = $fileName . '.' . $extension;
            $this->storage->disk('local')->put($fullName, file_get_contents($request->file('image')->getRealPath()));

            $product->image = $fullName;
        }

        $product->save();

        return redirect('products/view/' . $product->code)->with('message', 'Product successfully updated');;
    }

    public function getProductData()
    {
        $product = Product::where('id', $_REQUEST['product_id'])->first();
        
        return $product;
    }

    public function exportProducts() {
        $products = Product::all(['code', 'type', 'color', 'description', 'quantity', 'd13', 'd46', 'd6'])->toArray();
        $this->excel->create('Products', function($excel) use ($products) {
            $excel->sheet('Products', function($sheet) use ($products) {

                $sheet->appendRow()->fromArray($products, null, 'A1', null, null);
                $sheet->prependRow(1, array(
                    'Product Code', 'Type', 'Colour', 'Description', 'Quantity', 'Pricing (SGD)'
                ));
                $sheet->prependRow(2, array(
                    '', '', '', '', '', '1-3 Days', '4-6 Days', '> 6 Days'
                ));
                $sheet->mergeCells('F1:H1');
                $sheet->mergeCells('A1:A2');
                $sheet->mergeCells('B1:B2');
                $sheet->mergeCells('C1:C2');
                $sheet->mergeCells('D1:D2');
                $sheet->mergeCells('E1:E2');

                $sheet->setFontSize(15);
                $sheet->setBorder('A1:H2', 'thin');

                $sheet->cells('A1:H1000', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('middle');
                    $cells->setFontSize(15);
                });
            });
        })->export('xlsx');
        return view('product.index', ['products' => $products, 'page_title' => 'Products']);
    }

}