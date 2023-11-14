<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Technology extends Model
{


    protected $fillable = ['name', 'slug'];

    public static function generateSlug($name)
    {
        return Str::slug($name, '-');
    }

    use HasFactory;




    public function project(): BelongsToMany  // qui associo i progetti mentre in project metto le tecnologies
    {
        return $this->belongsToMany(Project::class);
    }
}
