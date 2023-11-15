<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Type;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'cover_image', 'description', 'type_id', 'r_link', 'github'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class); // questo progetto appartiene ad un tipo

    }


    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class); // questo progetto appartiene ad un tipo

    }
}
