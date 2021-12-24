<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Penangkaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kandang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function penangkaran()
    {
        return $this->belongsTo(Penangkaran::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function createkandang($data)
    {
        return DB::table('kandangs')->insert($data);
    }
}