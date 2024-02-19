<?php
namespace Tests\Feature\Club;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * @group routes.integrity
 */
class ClubsRoutesIntegrityTest extends TestCase
{
    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected bool $seed = false;

    /**
     * @covers ClubController::index
     */
    public function test_that_index_route_works(): void
    {
        $response = $this->getJson(route('v1:clubs.index'));

        $response->assertStatus(200);
    }

    /**
     * @covers ClubController::store
     */
    public function test_that_store_route_works(): void
    {
        $response = $this->postJson(route('v1:clubs.store'), []);

        $response->assertStatus(401);
    }

    /**
     * @covers ClubController::show
     */
    public function test_that_show_route_works(): void
    {
        $response = $this->getJson(route('v1:clubs.show', 1));

        $response->assertStatus(401);
    }

    /**
     * @covers ClubController::update
     */
    public function test_that_update_route_works(): void
    {
        $response = $this->getJson(route('v1:clubs.update', 1));

        $response->assertStatus(401);
    }

    /**
     * @covers ClubController::delete
     */
    public function test_that_delete_route_works(): void
    {
        $response = $this->getJson(route('v1:clubs.delete', 1));

        $response->assertStatus(401);
    }
}
