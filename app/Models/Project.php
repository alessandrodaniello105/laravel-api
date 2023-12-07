<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Project extends Model
{
    use HasFactory;

    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    protected $fillable = ['title', 'slug', 'description', 'type_id', 'link', 'image', 'image_original_name'];
}
