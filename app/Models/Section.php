<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_name',
        'description',
        'created_by',
    ];
  
    public function products()
    {
        return $this->hasMany(Prodacts::class);
    }
    public function bills()
{
    return $this->hasMany(Bill::class, 'section_id');
}

    protected static function boot()
{
    parent::boot();

    static::deleting(function ($section) {
        Bill::where('section_id', $section->id)->update(['section_id' => null]);
    });
}

}
