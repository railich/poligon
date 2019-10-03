<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    // подключим trait для того, чтобы в выборке не участвовали удаленные позиции
    use SoftDeletes;
}
