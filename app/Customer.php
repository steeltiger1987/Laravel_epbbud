<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 08:32
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    
    protected $table = 'customers';
    protected $fillable = ['company_name', 'company_address', 'payment_terms', 'abbreviation', 'default_discount'];

    public function pics()
    {
        return $this->hasMany('App\Pic');
    }
}