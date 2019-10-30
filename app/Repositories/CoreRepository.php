<?php
/**
 * Created by PhpStorm.
 * User: sabirov
 * Date: 2019-10-14
 * Time: 21:06
 */

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 * @package App\Repositories
 *
 * Репозиторий работы с сущностью.
 * Может выдавать наботы данных.
 * Не может создавать / изменять сущности.
 */
abstract class CoreRepository
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        // создаем объект черз сервис контейнер или сервис провайдер, хотя можно было new $this->getModelClass()
        $this->model = app($this->getModelClass());
    }

    /**
     * Имя модели будет сообщать класс потомок, в котором нужно будет реализовать эту функцию
     *
     * @return mixed
     */
    abstract protected function getModelClass();


    /**
     * Часть запроса, запрос к клонированной модели - фабрика
     *
     * @return Model|\Illuminate\Foundation\Application|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }

}