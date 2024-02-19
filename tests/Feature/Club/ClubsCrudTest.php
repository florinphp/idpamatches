<?php
namespace Tests\Feature\Club;

use Database\Seeders\UserSeeder;
use Tests\TestCase;

/**
 * @group routes.integrity
 */
class ClubsCrudTest extends TestCase
{
    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected bool $seed = false;
    protected array $headers;
    protected int $newlyCreatedTest;

    public function setUp(): void
    {
        parent::setUp();
        $loginResponse = $this->postJson(route('v1:auth.login'), UserSeeder::getTestUser());
        $this->headers = [
            'Authorization' => 'Bearer ' . $loginResponse->json('token'),
        ];
    }

    /**
     * @covers ClubController::store
     */
    public function test_that_creation_works(): int
    {
        $response = $this
            ->withHeaders($this->headers)
            ->postJson(
                route('v1:clubs.store'),
                [
                    'name' => 'Test Club 1',
                    'country' => 'UK',
                ]
            );

        $response->assertStatus(200);
        $response->assertJsonPath('id', fn (string $item) => is_numeric($item));
        $response->assertJsonPath('name', fn (string $item) => is_string($item));
        $response->assertJsonPath('country', fn (string $item) => is_string($item));

        return $response->json('id');
    }

    /**
     * @covers ClubController::store
     * @depends test_that_creation_works
     */
    public function test_that_show_works(int $id): void
    {
        $response = $this
            ->withHeaders($this->headers)
            ->getJson(route('v1:clubs.show', $id));

        $response
            ->assertStatus(200)
            ->assertJsonPath('id', $id)
            ->assertJsonPath('name', 'Test Club 1')
            ->assertJsonPath('country', 'UK');
    }

    /**
     * @covers ClubController::store
     * @depends test_that_creation_works
     */
    public function test_that_update_works(int $id): void
    {
        $response = $this
            ->withHeaders($this->headers)
            ->putJson(
                route('v1:clubs.update', $id),
                [
                    'name' => 'Test Club 1 Updated',
                    'country' => 'Albania',
                ]
            );

        $response
            ->assertStatus(200)
            ->assertJsonPath('id', $id)
            ->assertJsonPath('name', 'Test Club 1 Updated')
            ->assertJsonPath('country', 'Albania');
    }

    /**
     * @covers ClubController::store
     * @depends test_that_creation_works
     */
    public function test_that_delete_works(int $id): void
    {
        $response = $this
            ->withHeaders($this->headers)
            ->deleteJson(route('v1:clubs.delete', $id));

        // we first test that the request was successful
        $response->assertStatus(200);

        // then we test that the resource cannot be found
        $responseShow = $this
            ->withHeaders($this->headers)
            ->getJson(route('v1:clubs.show', $id));

        $responseShow->assertStatus(404);

    }
}
