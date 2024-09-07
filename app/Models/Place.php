<?php

namespace App\Models;

use App\Helpers\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'view_count'];

    public function getImageAttribute($image)
    {
        return asset('storage/images/' . $image);
    }
    public function scopeSearch($query, $request)
    {
        if ($request->category) {
            $query->whereCategory_id($request->category);
        }
        if ($request->address) {
            $query->where('address', 'LIKE', '%' . $request->address . '%');
        }
    }
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Slug::uniqueSlug($value, 'places');
    }
    public function bookmarkes()
    {
        $this->belongsToMany(User::class, 'bookmarks');
    }
}
