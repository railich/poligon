<?php
namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    /**
     * Переменая для не явной связи с репозиторием постов, DI
     *
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;


    public function __construct()
    {
        parent::__construct();

        // Создаем объект из класса, сложным путем, можно было просто new...
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if(empty($item)) {
            abort(404);
        }

        // Получаем список категорий для комбобокса (выпадающего списка)
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        // Получаем форму для редактирования поста
        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        // получаем все данные из таблицы
        $data = $request->all();

        // Если нет slug для url, создаем
        if(empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['title']);
        }

        // Зададим дату и время публикации если опубликовано
        if(empty($item->published_at) && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        }

        // Сохраним изменения, обновим
        $result = $item->update($data);

        if($result) {
            // Переходим на страницу редактирования с сообщением
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено!']);
        } else {
            // Возвращаемся назад с заполненными полями
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
        dd(__METHOD__, $id, \request()->all());
    }
}
