<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\AssignOp\Mod;

/**
 * class BlogPost
 *
 * @package App\Models
 *
 * @property int $id
 * @property \App\Models\BlogCategory           $category
 * @property \App\Models\User                   $user
 * @property int                                $category_id    Категория поста
 * @property int                                $user_id        автор статьи
 * @property string                             $slug           уникальный title в транслите для url
 * @property string                             $title          Заголовок статьи
 * @property string|null                        $excerpt        Выдержка из статьи
 * @property string                             $content_raw    Статья в формате markdown
 * @property string                             $content_html   Статья в формате html, создается автоматом из raw
 * @property boolean                            $is_published   Опубликовано = 1 или нет = 0
 * @property string|null                        $published_at   Дата опубликования
 * @property \Illuminate\Support\Carbon|null    $created_at
 * @property \Illuminate\Support\Carbon|null    $updated_at
 * @property string|null                        $deleted_at
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BlogPost onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereContentHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereContentRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlogPost whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BlogPost withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BlogPost withoutTrashed()
 * @mixin \Eloquent
 */
class BlogPost extends Model
{
    // подключим trait для того, чтобы в выборке не участвовали удаленные позиции
    use SoftDeletes;

    // Объявим поля которые доступны для заполнения
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
        'user_id'
    ];

    /**
     * Категория статьи
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        // Статья принадлежит категории, связка определяется атоматом через category_id
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Автор статьи
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // Статья принадлежит автору/пользователю
        return $this->belongsTo(User::class);
    }
}
