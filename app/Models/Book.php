<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [ 
        'title', 
        'writer', 
        'user_id', 
        'category_id', 
        'publisher', 
        'year' 
        ]; 
        
        public function user(): BelongsTo 
        { 
            return $this->belongsTo(related: User::class); 
        } 
        
        public function category(): BelongsTo 
        { 
            return $this->belongsTo(related: Category::class); 
        }
}
