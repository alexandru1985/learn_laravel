<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    protected $fillable = ['book_id', 'author_id'];
    protected $table = 'book_author';
}