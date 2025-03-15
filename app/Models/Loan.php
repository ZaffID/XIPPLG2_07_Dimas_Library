<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Loan; 
use Illuminate\Http\Request;

class Loan extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'loan_date',
        'return_date',
        'status'
    ];    
}
