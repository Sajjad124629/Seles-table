<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table = 'stores';
    protected $primaryKey = 'store_id';

    protected $fillable = [
        'store_name','is_active','created_at','updated_at'
    ];

    public $timestamps = false;

}
