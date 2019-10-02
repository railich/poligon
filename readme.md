<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Learn from video

        https://www.youtube.com/watch?v=jlplQaItZa0&list=PLoonZ8wII66iP0fJPHhkLXa3k7CMef9ak&index=5


##Install

- install laravel framework v 5.7.x , установить в текущуюю папку (./)
 
        composer create-project --prefer-dist laravel/laravel ./ "5.7.*" 
        
- server root folder with "public" - настраиваем в apache или в nginx

        server_root /var/www/test.tst/public

- folder access for mac or linux

        sudo chmod 777 -R storage && sudo chmod 777 -R bootstrap/cache