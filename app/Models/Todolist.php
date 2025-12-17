<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todolist extends Model
{
    /** @use HasFactory<\Database\Factories\TodolistFactory> */
    use HasFactory;

    protected $table = 'todolists';
    protected $guarded = ['id'];
    public $fillable = ['todo', 'description', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
