Directivas @can @cannot y @elsecan en blade

1.- Crear prueba ListPostTest

2.- Declarar la routa admin/posts dentro del grupio de rutas admjin

3.- Crear el metodo indesx en l postcontroler

4.- Crear la vita admin/post/index.

5.- Añadir la autenticación básica. Make auth

6.- quitar la ruta que tenemos existente de login porque ya estará la de auth

7.- Crear el PostSeeder (registrar en DatabaseSeeders!!!!!) --> $this->call(PostSeeder::class);

8.- Paginación $Post::paginate() en el controlador y $post->links() ebn la view

9.- En el modelo post añadir la relacion entre post y usuario (se hace cambiando el nombre por eso es author)
	 public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

10.- Añadir la ruta edit y modificar el metodo edit(= en el Controlladore.

11.- @can ('update', $post)
	@endcan 
	En vez de usar if en las vistas.

12.- En zonas en las que no trabajamos con modelo pasamos la clase como segúndo argumento
	@can('create', App\Post::class)

------------------------------------

Ocultar registros de BBDD

1.- Modificar la clase ListPostTest (comentar el método existente y añair el nuevo.

2.- Forma 1 para filtar el método index
	$posts = Post::where('user_id', auth()->id())->paginate() 
Pero no funcionaria para los admins

3.- Forma buena
	$posts = Post::query()
		->unless(auth()->user()->idAdmin(), function ($q) {
			$q->where('user_id', auth()->id());
		})
		->paginate();
        
        --------------------------------------------------
        
        Agregar filtros a los policys. Permitir o prohibir todas las acciones dentro de un filtro método before().

Es lo mismo que el before en el authSerivceProvider pero que solo aplicará a los métodos del plicy en cuestion.
