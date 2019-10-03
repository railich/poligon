<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Learn from video

        https://www.youtube.com/watch?v=jlplQaItZa0&list=PLoonZ8wII66iP0fJPHhkLXa3k7CMef9ak&index=5


##Install - steps

- install laravel framework v 5.7.x , установить в текущуюю папку (./)
 
        composer create-project --prefer-dist laravel/laravel ./ "5.7.*" 
        
- server root folder with "public" - настраиваем в apache или в nginx

        server_root /var/www/test.tst/public

- folder access for mac or linux

        sudo chmod 777 -R storage && sudo chmod 777 -R bootstrap/cache
        
- Создаем базы данных для проекта
        
       CREATE DATABASE `poligon` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; 
       CREATE DATABASE `poligon_prototype` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; 
       CREATE DATABASE `poligon_test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; 

- Установка плагина для IDE (https://github.com/barryvdh/laravel-ide-helper)

        composer require --dev barryvdh/laravel-ide-helper
        
        # далее добавим в composer.json добавляем скприпт
        "scripts":{
            "post-update-cmd": [
                "Illuminate\\Foundation\\ComposerScripts::postUpdate",
                "@php artisan ide-helper:generate",
                "@php artisan ide-helper:meta"
            ]
        },

- Установка плагина для IDE (https://github.com/barryvdh/laravel-debugbar)

        composer require barryvdh/laravel-debugbar --dev


## Если проект склонирован в каталог, что нужно сделать:

- .env - Нужно создать файл с настройками, который отсутсвует/не копируется в git

        cp ./.env.example ./.env
        
- Создаем ключ для приложения

        php artisan key:generate
        
- Обновить модули композера и сгенерить /vendor

        compose update        
        
        


## Блог

- создание модели и миграции

        php artisan make:model Models/BlogCategory -m
        
- чтобы миграции работали на более новых БД нужно добавить длинну строки по умолчанию:
    Миграции хранятсяв каталоге: database/migrations

        Добавить в AppServiceProvider->boot() 
        
            Schema::defaultStringLength(191);
            
- Запуск миграций

        php artisan migrate

- Добавить фейковые данные можно с помощью Сидеров и Фабрики. Добавляем данные с помощью сида. 
    Хранятся в каталоге database/seeds

        php artisan make:seeder UserTableSeeder

- Запуск сидов

        php artisan db:seed
        php artisan db:seed --class=UserTableSeeder
        
        // Сначала все удалим, потом накатим все миграции и сиды
        php artisan migrate:refresh --seed
        
        // Если выходит ошибка, что нет классов с сидами ReflectionException  : Class UsersTableSeeder does not exist
            связано это с Composer.json он прописывает классы в Class map, которые связаны с database классом.
            
        composer dumpautoload

        
        
- Создаем фабрики factory и связываем модель BlogPost

        php artisan make:factory BlogPostFactory --model="App\Models\BlogPost"
        
- Создание rest тестового контроллера, с ресурсами - rest функциями (--resource)

        php artisan make:controller RestTestController --resource    
        
- Создание контроллеров блога 
    
        php artisan make:controller Blog/BaseController
        
        // Создадим ресурсный контроллер постов
        php artisan make:controller Blog/PostController --resource
        
        
        
## Дополнительно

- Преобразование строки в slug для URL

        $slug = str_slug('string');
        
        или в более новой версии laravel
        
        $slug = Str::slug('string');


- Получаем хеш пароля 

        $password = bcrypt('123123);
        
- Если при создании таблицы в миграциях мы добавили softDeletes(), тогда в модель
    тоже нужнжо добавить трейт SoftDeletes. При выборке будт выбираться только 
    не удаленные записи. 
    
        class BlogPost extends Model 
        {
            use SoftDeletes;
        }  
    
    чтобы показать все записи, вместе с удаленными в контроллере нужно писать запрос
    с методом withTrashed()
    
    
        $items = BlogPost::withTrashed()->all()
        
        