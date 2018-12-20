1.- Añadir controlador Admin/PostController.

2.- Quitar la función anóima del web.php del put y crearlo en el como método update

3.- Modificar web.php para hacer en el put referencia al controlador

4.- Quitar el middleware can y añadir en el controler al principio la llamada al método authorize heredado de la clase 

controller a treavés de un treat. Ahora a Dulio le da el error que nos daba a nosotros antes.
	// Si el usuario tiene permiso, se ejecutara el resto del código de este método, de lo contrario, se arrojará una 

excepción.
	$this->authorize('update', $post);

5.- Solución: En el handler App\Exception\Handler. Método render, se hace un if que comprueba si la execpion es  del tipo 

authorizacion y si lo es entonces que se compruebe si el usuario es anonimo y si lo es que haga redireccion a login.
	//        if ($exception instanceof AuthorizationException) {
//            if (auth()->guest()) {
//                return redirect()->route('login');
//            }
//        }

6.- Otra solución es añadir el middleware auth a la ruta. O grupos de rutas. Esta es la que dejamos.
	Route:middleware('auth'->namespace('Admin\\')->group(function...

7.- formRequest. Crear 1
	php artisan make:request UpdatePostRequest
	Para usarlo hay que llamar a los Gates desde el métdo authorize
		return Gate::allows('update', $this->post);
	Si se usa, en la llamada al método update del controlador se llama a la clase request creada en vez de la request 

base en vez de
	En este punto es cuando podemos quitar la llamda a authorize del PostController

8.- Crear post prueba clase
	añadir ruta para creacion e psot

9.- Añadir la relacion hasMany en el model user.
	    public function posts()
    {
        return $this->hasMany(Post::class);
    }

10.- Modificar el método create User de testCase para que coja argumentos.

11.- Añadir el código de create en la policy

USAR MEJOR SIEMPRE EL AUTHORIZE QUE EL FROMREQUEST
