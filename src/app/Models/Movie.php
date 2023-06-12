<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author_id', 'genre_id', 'description', 'price', 'year'];

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function jsonSerialize(): mixed
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->director->name,
            'genre' => ($this->genre ? $this->genre->name : ''),
            'price' => floatval(number_format($this->price, 2)),
            'year' => intval($this->year),
            'image' => asset('images/' . $this->image),
        ];          
    }
}
