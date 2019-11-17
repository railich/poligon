<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;


class BlogPostRepository extends CoreRepository
{
    /**
     * Реализация метода абстрактного класса получение названия класса модели
     * в данном случае App\Models\BlogPost
     *
     * @return string - App\Models\BlogPost
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получаем список статей с пагинацией, для вывода в списке
     * (Админка)
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        // Поля, которые нам нужно вывести
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')

            // Дополним запрос отношениями/ связанными таблицами - lazy load (жадная загрузка)
            // Способ №1 - Загружаем все поля (хотя используем только два name и titile)
            // для этого в модели BlogPost нужны функции связанных объектов category() user() --> belongsTo
            //->with(['category', 'user'])

            // Способ №2 конкретизируем какие поля нам нужны, с помощью подфункции
            // id - нужен для связи данных
            ->with([
                'category' => function($query) {
                    // Выбираем конкретные поля - уменьшаем скорость запроса
                    $query->select(['id', 'title']);
                },

                // Более короткая запись - синтаксический сахар
                'user:id,name',
            ])

            ->paginate(25);

        return $result;
    }

    /**
     * Получаем модель для редактирования в админке
     *
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}