<?php
namespace Tests\Unit;
use Tests\TestCase;
use App\{Post, User};
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
class PostPolicyTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function admins_can_update_posts()
    {
        // Arrange
        $admin = $this->createAdmin();
        $this->be($admin); // = actingAs($admin)
        $post = new Post;
        // Act
        $result = Gate::allows('update-post', $post); //Comprueba si se puede acceder al post. Este gate tiene que estar registrado en authServiceProvider
        // Assert
        $this->assertTrue($result);
    }

    /** @test */
    function authors_can_update_posts()
    {
        // Arrange
        $user = $this->createUser();
        $this->be($user);
        $post = factory(Post::class)->create([
            'user_id' => $user->id,
        ]);
        // Act
        $result = Gate::allows('update-post', $post);
        /*
         * $result = $admin->can('update-post', $post);
	     *  $result = $admin->cannot('update-post', $post);
	     *  $result = auth()->user()->can('update-post');
         */
        // Assert
        $this->assertTrue($result);
    }
    /** @test */
    function unathorized_users_cannot_update_posts()
    {
        // Arrange
        $user = $this->createUser();
        $post = factory(Post::class)->create();
        // Act
        $result = Gate::forUser($user)->allows('update-post', $post);
        // Assert
        $this->assertFalse($result);
    }
    /** @test */
    function guests_cannot_update_posts()
    {
        // Arrange
        $post = factory(Post::class)->create();
        // Act
        $result = Gate::allows('update-post', $post);
        // Assert
        $this->assertFalse($result);
    }


}