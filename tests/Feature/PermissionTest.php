<?php


use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PermissionTest extends TestCase
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

    public function test_viewer_cannot_see_permissions()
    {
        $viewer = $this->get_viewer();
        // login user as viewer
        Sanctum::actingAs($viewer, ['*']);

        // permissions index page
        $response = $this->getJson('/api/v1/permissions');
        $response->assertForbidden();
    }

    public function test_admin_can_create_new_permission()
    {
        $admin = $this->get_admin();
        // login user as viewer
        Sanctum::actingAs($admin, ['*']);

        // permissions index page
        $response = $this->postJson('/api/v1/permissions', [
            'name' => 'Test permission from test',
            'description' => 'Test desc'
        ]);
        $response->assertOk();
    }

    public function test_viewer_cannot_create_new_permission()
    {
        $viewer = $this->get_viewer();
        // login user as viewer
        Sanctum::actingAs($viewer, ['*']);

        // permissions index page
        $response = $this->postJson('/api/v1/permissions', [
            'name' => 'Test permission from test',
            'description' => 'Test desc'
        ]);
        $response->assertForbidden();
    }


    /**
     * Создать пользователя-админа
     *
     * @return User
     */
    public function get_admin(): User
    {
        $admin = $this->get_user();
        $admin->syncRoles([$this->roles[Role::ADMIN]]);

        return $admin;
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
