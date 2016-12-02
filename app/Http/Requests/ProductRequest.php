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
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code'        => 'required|unique:products,code',//|unique:products,code',
            'type'        => 'required',
            'color'       => 'required|alpha_num',
            'description' => 'required|string',
            'quantity'    => 'required|integer',
            'd13'         => 'required',
            'd46'         => 'required',
            'd6'          => 'required',
            'image'       => 'image|max:2000'
        ];
    }
}