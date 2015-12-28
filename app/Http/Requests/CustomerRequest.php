<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 08:39
 */

namespace App\Http\Requests;


class CustomerRequest extends Request
{

    public function authorize() {
        return true;
    }

    public function rules() {
        return [];
    }

}