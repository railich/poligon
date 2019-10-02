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