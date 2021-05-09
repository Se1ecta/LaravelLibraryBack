<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    protected $table = 'books';
    public $timestamps = true;

    protected $casts =[
        'rating' => 'float'
    ];

    protected $fillable =[
        'title',
        'author',
        'category',
        'description',
        'rating',
        'image'
    ];
    

    public function author()
    {
        return $this->hasOne(Author::class, 'id_author');
    }
    public function category()
    {
        return $this->hasMany(Category::class, 'id_category')->select(['id_category', 'title']);
    }
}
