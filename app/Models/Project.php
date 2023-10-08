<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'language' => 'array',
        'creation_date' => 'date'
    ];

    protected $fillable = [
        'title',
        'description',
        'thumb',
        'creation_date',
        'link',
        'language',
        'slug'
    ];
}
