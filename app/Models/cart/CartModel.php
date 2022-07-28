<?php

namespace App\Models\cart;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "addtocart";
    protected $primaryKey = "id";
}
