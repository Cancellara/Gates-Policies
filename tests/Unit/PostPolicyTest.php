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
    protected function createAdmin()
    {
        return factory(User::class)->states('admin')->create();
    }
}