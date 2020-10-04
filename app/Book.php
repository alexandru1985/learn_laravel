<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'language_id'];
    protected $table = 'books';
    
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
    
    public function authors()
    {
        return $this->belongsToMany('App\Author','book_author');
    }
}