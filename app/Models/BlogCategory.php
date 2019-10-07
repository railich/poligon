<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\BlogCategory
 *
 * @property int $id
 * @property int $parent_id Категория может быть вложенной
 * @property string $slug уникальный title в транслите для url
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BlogCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BlogCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BlogCategory withoutTrashed()
 * @mixin \Eloquent
 */
class BlogCategory extends Model
{
    use SoftDeletes; // Это трейт, для исключения из выборки удаленых полей (deleted_at is null)

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description'
    ];
}
