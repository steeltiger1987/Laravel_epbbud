<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 07:46
 */

namespace App\Http\Requests;


class ProductRequest extends Request
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [];
    }
}