<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Выбрать все данные с пагинацией, по 5 элементов на странице
        $paginator = BlogCategory::paginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();

        // Псвевдоним для url
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }

        // Создаем объект и сохраняем в БД, способ №1 - save
//        $item = new BlogCategory($data);
//        $item->save();

        // Создаем объект и сохраняем в БД, способ №2 - create
        $item = (new BlogCategory())->create($data);

        if ($item) { // или можно проверить $item->exist или $item instanceof BlogCategory
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success', 'Успешно сохранено']);
        } else {
            return back() // возвращаемся назад, к форме
                ->withInput() // Возвращаем все что ввели на форме
                ->withErrors(['msg' => "Ошибка сохранения"]); // Выводим ошибку
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogCategoryUpdateRequestAlias $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        // Правила валидации
//        $rules = [
//            'title' => 'required|min:5|max:200',
//            'slug' => 'max:200',
//            'description' => 'string|max:500|min:3',
//            'parent_id' => 'required|integer|exists:blog_categories,id',
//        ];

        // первый способ отвалидировать данные
        //$validatedData = $this->validate($request, $rules);


        // Второй способ валидации в реквесте
        //$validatedData = $request->validate($rules);

        // Третий способ, создаем не посредственно объек валидатор
        //$validator = \Validator::make($request->all(), $rules);

        // Разные вызовы валидации данных
//        $validatedData[] = $validator->passes(); // Если нет ошибок == true
//        $validatedData[] = $validator->validate(); // Если есть ошибки, редиректит с withErrors
//        $validatedData[] = $validator->valid(); // Возвращает только валидные поля
//        $validatedData[] = $validator->failed(); // Возвращает только НЕ валидные поля
//        $validatedData[] = $validator->errors(); // Возвращает описание ошибок
//        $validatedData[] = $validator->fails(); // Если есть ошибки == true


//        dd($validatedData);


        $item = BlogCategory::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        // Загрузка и сохранение данных, способ №1
//        $result = $item->fill($data)->save();

        // Загрузка и сохранение данных, способ №2
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
