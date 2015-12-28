<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 08:32
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['company_name', 'pic_name', 'pic_email', 'pic_contact', 'website'];
}