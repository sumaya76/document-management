<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'filename',
        'file_path',
        'category_id',
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Optional: Accessor for getting the full URL of the file
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}
