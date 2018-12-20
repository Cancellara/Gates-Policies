Policies asociadas a modelos: Uso de politicas en vez de gates

1.- Renombrar PostPolicy a old_postpolicy

2.- crear nueva PostPolicy enlazando al modelo Post
	php artisan make:policy PostPolicy --model=Post

3.- Hay que enlazar de forma manual yendo a AuthServiceProvider y en protectted $policies renombrar la línea 'App\Model' =>... y añadir 'App\Post' => 'App\Policies\PostPolicy',

4.- En los tests en las llamadas de los gates podemos cambiar los post.update por update porque laravel ya va a saber que policy hay enlazada

5.- Añadir la lógica del OldPolicy al nuevo.

6.- Ahora ya se puede eliminar el Gate::resource deboot del authorizeServiceprobvider y elimnar la clase OldPolicy

7.- Laravel recomienda el uso de politicas asociadas a modelo cuando sean reaglas asociadas a un modelo y Gate::define para reglas no asociadas a modelos. Ejemplo de uso de Gate:: saber si un usuario tiene permiso para ver un dashboard que no depende de un modelo. Gate::define('view-dashboard');

8.- En la clase PostPolicy se pueden añadir métodos adicionales como publish
