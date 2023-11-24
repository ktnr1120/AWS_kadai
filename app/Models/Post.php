<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id'
    ];
        
    public function getPaginateByLimit(int $limit_count = 5)
    {
        //updated_atで降順に並べた後、limitで件数制限をかける
        return $this::with('category','user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //DESC＝降順、ASC＝昇順
    }
    
    //「1対多」の関係なので単数系に
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    //「1対多」の関係なので単数系に
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


