<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    public $timestamps = true;
    
    protected $fillable =[
        'name',
        'surname',
        'category',
        'date_of_birth',
        'date_of_death',
        'image'
    ];
    public function books()
    {
        return $this->hasMany(Book::class, 'author', 'id');
    }
}
