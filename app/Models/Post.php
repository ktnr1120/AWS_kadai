<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getPaginateByLimit(int $limit_count = 9)
    {
        //updated_atで降順に並べた後、limitで件数制限をかける
        return $this->orderBy('updated_at', 'ASC')->paginate($limit_count);
        //DESC＝降順、ASC＝昇順
    }

    use HasFactory;
}

