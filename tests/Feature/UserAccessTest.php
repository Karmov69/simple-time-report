<?php

namespace Tests\Feature;

use App\Report;
use App\Role as RoleConst;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;


class UserAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * setUp test with seeding database
     */
    protected function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanUserViewUsers() {
        $firstUser = User::query()->first();
        $user = factory(User::class)->create(['lastname' => 'testLastName']);

        $user->assignRole(RoleConst::ROLE_ADMIN);
        $response = $this->actingAs($user)->get('/users');
        $response->assertStatus(200);

        $user->assignRole(RoleConst::ROLE_ADMIN);
        $response = $this->actingAs($user)->get('/users/create');
        $response->assertStatus(200);

        $user->assignRole(RoleConst::ROLE_ADMIN);
        $response = $this->actingAs($user)->get('/users/'. $firstUser->id .'/edit');
        $response->assertStatus(200);
    }

    public function testHome()
    {
        $user = factory(User::class)->create(['lastname' => 'testLastName']);
        $user->removeRole(RoleConst::ROLE_ADMIN);
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }

     public function testCanUserCRUDMyReports()
     {
         factory(Report::class)->create();

         $user = factory(User::class)->create(['lastname' => 'testLastNmae']);
         $user->assignRole(RoleConst::ROLE_USER);
         $response = $this->actingAs($user)->get('/my-reports');
         $response->assertStatus(200);

         //Edit
         $firstReport = Report::query()->first();

         $user = factory(User::class)->create(['lastname' => 'testLastNmae']);
         $user->assignRole(RoleConst::ROLE_USER);
         $response = $this->actingAs($user)->get('/my-reports/'. $firstReport->id . '/edit');
         $response->assertStatus(200);

     }

     public function testCanUserViewReports() {
         $firstReport = Report::query()->first();

         $user = factory(User::class)->create(['lastname' => 'testLastNmae']);
         $user->assignRole(RoleConst::ROLE_ADMIN);
         $response = $this->actingAs($user)->get('/reports?user='. $firstReport->id);
         $response->assertStatus(200);

         $user = factory(User::class)->create(['lastname' => 'testLastNmae']);
         $user->assignRole(RoleConst::ROLE_ADMIN);
         $response = $this->actingAs($user)->get('/reports?user=all');
         $response->assertStatus(200);

         $user = factory(User::class)->create(['lastname' => 'testLastNmae']);
         $user->assignRole(RoleConst::ROLE_ADMIN);
         $response = $this->actingAs($user)->get('/reports/'. $firstReport->id . '/edit');
         $response->assertStatus(200);
     }
}
