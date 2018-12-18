1.- Duplicar la prueba y renombrarla a guests_cannot_update_posts(). Eliminar la creación del usuario. AssertFalse.

2.- Método Gate::forUser, para probar el Gate sobre un usuario distinto al que esta conectado.
	$result = $admin->can('update-post', $post);
	$result = $admin->cannot('update-post', $post);
	$result = auth()->user()->can('update-post');

3.- Prueba unathorized_users_cannot_update_posts() y createUser() método.

4.- Añadir en el boot the AuthServiceProvider la parte nueva, donde se comprueba que el usuario es administrador.

5.- Prueba authors_can_update:posts

6.- Añadir la columna y la llave foranea en posts y el factory

7.- Añadir en el gate el || para que el autor pueda.

8.- Método isAdmin en el model user y refactorización en la llamada al gate. 

9.- Refactorizar también con owns($post) que indica si el usuario es el propietario del post
	Crear clase prueba unitaria UserModelTest para probar owns
		a_user_can_be_owner_of_a_model
	Mover el create_user y eel createadmin a testcase
	Crear la clase auxiliar OwnedModel en la propia clase de prueba
	Crear el método owns en el modelo user
	Usar owns en el gate
