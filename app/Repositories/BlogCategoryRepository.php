<?php


namespace App\Repositories;

use App\Models\BlogCategory as Model;


class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Подготовка формы для редактирования
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit(int $id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получение списка категорий для создания выпадающего списка для выбора родителя
     */
    public function getForComboBox()
    {
        $columns = implode(', ', [
            'id',
            'CONCAT(id, ". ", title) as id_title'
        ]);

        // Разные способы получения результата
        /*
        // Получить все данные (all - получить много данных, это избыточно)
        $result = $this
            ->startConditions()
            ->all();

        // Получение только нужных полей
        $result[] = $this
            ->startConditions()
            ->select('blog_categories.*',
                // вставка строки в селект с правильным преобразованием...
                \DB::raw('CONCAT(id, ". ", title) as id_title'))
            // toBase - вернет в ответе, только поля из БД/класса, без ненужных технических полей
            ->toBase()
            ->get();
        */


        // Получение только нужных полей, короткая запись
        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            // toBase - вернет в ответе, только поля из БД/класса, без ненужных технических полей
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Получить категории для вывода пагинатором
     *
     * @param int|null $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)

            // пагинация
            ->paginate($perPage);

        return $result;
    }
}