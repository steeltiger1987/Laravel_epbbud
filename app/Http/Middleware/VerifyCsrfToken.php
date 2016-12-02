<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'customers/create', 'customers/update', 'get-customers-list', 'get-address-and-pic-data', 'receive-product-data', 'get-quotations-list', 'get-quotation-data', 'get-invoices-list',
        'get-invoice-data', 'store-operation', 'get-codes', 'get-colors', 'delivery-order/store', 'delivery-order/show'
    ];
}
