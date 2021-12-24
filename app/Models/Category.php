<?php

namespace App\Models;

use App\Models\Kandang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kandangs()
    {
        return $this->hasMany(Kandang::class);
    }
    public function createkategori($data)
    {
        return DB::table('categories')->insert($data);
    }
    public function deletekategori($id)
    {
        return DB::table('categories')->where('id', $id)->delete();
    }
}