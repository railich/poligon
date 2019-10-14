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
        return $this->startConditions()->all();
    }
}