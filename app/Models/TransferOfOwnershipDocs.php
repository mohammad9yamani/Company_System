<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferOfOwnershipDocs extends Model
{
    use HasFactory;


    protected $table = 'transfer_of_ownership_docs';


    protected $fillable = [
        'company_id',
        'buyer_national_id',
        'seller_national_id',
        'vehicles_num',
        'buyer_phone',
        'seller_phone',
        'cost',
        'status',
    ];


    public $timestamps = true;

    public function company(){
        return $this->belongsTo(Company::class ,'company_id','id');
    }
}
