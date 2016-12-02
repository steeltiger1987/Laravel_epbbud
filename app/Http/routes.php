<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*Authentication and registration routes*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');

   // Route::get('register', 'Auth\AuthController@getRegister');
    //Route::post('register', 'Auth\AuthController@postRegister');
    /*===================================================*/
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', function () {
            return view('backend.index');
        });
        Route::get('profile', 'UserController@showProfile');
        Route::post('change-password', 'UserController@changePassword');


        Route::get('customers', 'CustomerController@index');
        Route::get('customers/new', 'CustomerController@newCustomer');
        Route::post('customers/create', 'CustomerController@storeCustomer');
        Route::any('customers/remove/{id}', 'CustomerController@removeCustomer');
        Route::get('customers/view/{abbreviation}', 'CustomerController@viewCustomer');
        Route::get('customers/view/edit/{abbreviation}', 'CustomerController@editCustomer');
        Route::post('customers/update', 'CustomerController@updateCustomer');
        Route::get('customers/export', 'CustomerController@exportCustomers');
        Route::get('customers/restore/{id}', 'CustomerController@restoreCustomer');

        Route::get('products', 'ProductController@index');
        Route::get('products/new', 'ProductController@newProduct');
        Route::post('products/create', 'ProductController@storeProduct');
        Route::any('products/remove/{id}', 'ProductController@removeProduct');
        Route::get('products/restore/{id}', 'ProductController@restore');
        Route::get('products/view/edit/{code}', 'ProductController@editProduct');
        Route::get('products/view/{code}', 'ProductController@viewProduct');
        Route::post('products/update', 'ProductController@updateProduct');
        Route::get('products/export', 'ProductController@exportProducts');

        Route::get('quantity-for-day', 'InventoryController@getProductQuantityForStartOfTheDay');

        Route::resource('quotation', 'QuotationController');
        Route::get('quotation', 'QuotationController@index');
        Route::get('quotation/new', 'QuotationController@create');
        Route::post('quotation/store', 'QuotationController@store');
        Route::any('quotation/remove/{id}', 'QuotationController@delete');
        Route::get('quotation/{id}/edit/', 'QuotationController@edit');
        Route::get('quotation/{id}', 'QuotationController@show');
        Route::post('quotation/update', 'QuotationController@update');
        Route::get('quotation/generate/{id}', 'PDFController@generateQuotation');

        Route::get('invoice', 'InvoiceController@index');
        Route::get('invoice/new', 'InvoiceController@create');
        Route::post('invoice/store', 'InvoiceController@store');
        Route::any('invoice/remove/{id}', 'InvoiceController@delete');
        Route::get('invoice/{id}/edit/', 'InvoiceController@edit');
        Route::get('invoice/{id}', 'InvoiceController@show');
        Route::post('invoice/update', 'InvoiceController@update');
        Route::get('invoice/generate/{id}', 'PDFController@generateInvoice');
        Route::get('invoice/void/{id}', 'InvoiceController@voidInvoice');

        Route::get('delivery-order', 'DeliveryOrderController@index');
        Route::get('delivery-order/new', 'DeliveryOrderController@create');
        Route::get('delivery-order/new/{invoiceNumber}', 'DeliveryOrderController@create');
        Route::post('delivery-order/store', 'DeliveryOrderController@store');
        Route::any('delivery-order/remove/{id}', 'DeliveryOrderController@delete');
        Route::get('delivery-order/{id}/edit/', 'DeliveryOrderController@edit');
        Route::get('delivery-order/{id}', 'DeliveryOrderController@show');
        Route::post('delivery-order/update', 'DeliveryOrderController@update');
        Route::get('delivery-order/generate/{id}', 'PDFController@generateDo');

        Route::post('get-customers-list', 'QuotationController@getCustomersForQuotationForm');
        Route::post('get-quotations-list', 'InvoiceController@getQuotationList');
        Route::post('get-address-and-pic-data', 'QuotationController@getCustomerAndPicDataForQuotationForm');
        Route::post('get-quotation-data', 'InvoiceController@getQuotationDataForInvoiceForm');
        Route::post('get-invoices-list', 'DeliveryOrderController@getInvoicesList');
        Route::post('get-invoice-data', 'DeliveryOrderController@getInvoiceData');
        Route::post('receive-product-data', 'ProductController@getProductData');

        Route::get('operation', 'OperationController@index');
        Route::get('store-operation', 'OperationController@store');

        Route::get('inventory/byproduct', 'InventoryController@index');
        Route::get('inventory/byproduct/{date}', 'InventoryController@showDate');
        Route::get('inventory/bydate', 'InventoryController@showByDate');

        Route::get('get-codes', 'InventoryController@selectProductCodes');
        Route::get('get-colors', 'InventoryController@selectProductColors');

        Route::get('users', ['as'=>'users/list',                     'uses'=>'UserController@index']);
        Route::get('users/new', 'UserController@newUser');
        Route::post('users/create', 'UserController@createUser');
        Route::get('users/edit/{id}',       ['as'=>'user/edit',                     'uses'=>'UserController@editUser']);
        Route::post('users/update/{id}',    ['as'=>'user/update',                   'uses'=>'UserController@updateUser']);
        Route::get('users/delete/{id}',    ['as'=>'user/delete',                   'uses'=>'UserController@deleteUser']);
        
        Route::any('accounting', 'AccountingController@index');
        Route::get('accounting/store', 'AccountingController@store');
        Route::get('accounting/outstanding', 'AccountingController@generateOutstanding');
        Route::post('accounting/sales-report', 'AccountingController@generateSalesReport');
        Route::get('accounting/export', 'AccountingController@export');
        Route::get('get-users-list', 'UserController@getUsersList');
    });
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
