<?php


use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    protected Collection $roles;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
        $this->seed(PermissionSeeder::class);
        $this->roles = Role::all()->pluck('id', 'name');
    }

    public function test_viewer_cannot_see_roles()
    {
        $viewer = $this->get_viewer();
        // login user as viewer
        Sanctum::actingAs($viewer, ['*']);

        // roles index page
        $response = $this->getJson('/api/v1/roles');
        $response->assertForbidden();
    }

    /**
     * Создать пользователя-Зритель
     *
     * @return User
     */
    public function get_viewer(): User
    {
        $viewer = $this->get_user();
        $viewer->syncRoles([$this->roles[Role::VIEWER]]);

        return $viewer;
    }

    /**
     * Создать пользователя
     *
     * @return User
     */
    public function get_user(): User
    {
        return User::factory()->create();
    }

}
