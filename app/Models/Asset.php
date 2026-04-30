<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    // This allows us to save data without mass-assignment errors
    protected $guarded = [];

    // The missing relationship! An asset belongs to one category.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // An asset can have a history of many loans
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    // An asset has one active loan where it hasn't been returned yet
    public function activeLoan()
    {
        return $this->hasOne(Loan::class)->whereNull('returned_at')->latestOfMany();
    }

    // An asset can have many defect reports
    public function defects()
    {
        return $this->hasMany(Defect::class);
    }
}
