No usar reglas anonimas en los Gates usando clases y métodos.

1.- Crear nueva regla php artisan make:policy PostPolicy
	Se crea en App/Policies

2.- Metodo update en la nueva policy y delete
	Solo contendra el return del gate policy (importar las clases)

3.- Enlazar la clase con el gate
	Gate::define('update-post', 'App\Policies\PostPolicy@uptdate');

4.- Hacer lo mismo con el gate delete-post

5.- Uilizar el método de Gate::resource
	Gate::resource('post', PostPolicy::class); //equivale a crear reglas para view, create, update, delete
	Se pueden eliminar las reglas, pero ahora las reglas pasan de update-post a post.update.

6.- Prueba unitaria de PostPolicy
	Modificar la prueba authors can update post:
		$result = (new PostPolicy)->update($user, $post);

7.- Definir reglas diferentes a updta, delete, view...etc, enviar array como parámetro a resource
	llave:nombre acción => valor
	Gate::resource('post', PostPolicy::class, [
		'update' => 'update',
		'delete' => 'delete'
		...
	]);
