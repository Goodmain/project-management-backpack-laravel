<?php

namespace App\Tests;

use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class ProjectTest extends TestCase
{
    protected $user;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::find(1);
    }

    public function testCreate()
    {
        $data = $this->getJsonFixture('create_project_request.json');

        $response = $this->actingAs($this->user)->json('post', '/projects', $data);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEqualsFixture('create_project_response.json', $response->json());

        $this->assertDatabaseHas('projects', $this->getJsonFixture('create_project_response.json'));
    }

    public function testCreateNoAuth()
    {
        $data = $this->getJsonFixture('create_project_request.json');

        $response = $this->json('post', '/projects', $data);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testUpdate()
    {
        $data = $this->getJsonFixture('update_project_request.json');

        $response = $this->actingAs($this->user)->json('put', '/projects/1', $data);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('projects', $data);
    }

    public function testUpdateNotExists()
    {
        $data = $this->getJsonFixture('update_project_request.json');

        $response = $this->actingAs($this->user)->json('put', '/projects/0', $data);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testUpdateNoAuth()
    {
        $data = $this->getJsonFixture('update_project_request.json');

        $response = $this->json('put', '/projects/1', $data);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testDelete()
    {
        $response = $this->actingAs($this->user)->json('delete', '/projects/1');

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('projects', [
            'id' => 1
        ]);
    }

    public function testDeleteNotExists()
    {
        $response = $this->actingAs($this->user)->json('delete', '/projects/0');

        $response->assertStatus(Response::HTTP_NOT_FOUND);

        $this->assertDatabaseMissing('projects', [
            'id' => 0
        ]);
    }

    public function testDeleteNoAuth()
    {
        $response = $this->json('delete', '/projects/1');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testGet()
    {
        $response = $this->actingAs($this->user)->json('get', '/projects/1');

        $response->assertStatus(Response::HTTP_OK);

        // TODO: Need to remove after first successful start
        $this->exportJson('get_project.json', $response->json());

        $this->assertEqualsFixture('get_project.json', $response->json());
    }

    public function testGetNotExists()
    {
        $response = $this->actingAs($this->user)->json('get', '/projects/0');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function getSearchFilters()
    {
        return [
            [
                'filter' => ['all' => 1],
                'result' => 'search_all.json'
            ],
            [
                'filter' => [
                    'page' => 2,
                    'per_page' => 2
                ],
                'result' => 'search_by_page_per_page.json'
            ],
        ];
    }

    /**
     * @dataProvider getSearchFilters
     *
     * @param array $filter
     * @param string $fixture
     */
    public function testSearch($filter, $fixture)
    {
        $response = $this->json('get', '/projects', $filter);

        $response->assertStatus(Response::HTTP_OK);

        // TODO: Need to remove after first successful start
        $this->exportJson($fixture, $response->json());

        $this->assertEqualsFixture($fixture, $response->json());
    }

}
