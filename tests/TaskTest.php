<?php

namespace App\Tests;

use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class TaskTest extends TestCase
{
    protected $admin;
    protected $user;

    public function setUp() : void
    {
        parent::setUp();

        $this->admin = User::find(1);
        $this->admin = User::find(2);
    }

    public function testCreate()
    {
        $data = $this->getJsonFixture('create_task_request.json');

        $response = $this->actingAs($this->admin)->json('post', '/tasks', $data);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEqualsFixture('create_task_response.json', $response->json());

        $this->assertDatabaseHas('tasks', Arr::except($data, ['labels']));
    }

    public function testCreateNoAuth()
    {
        $data = $this->getJsonFixture('create_task_request.json');

        $response = $this->json('post', '/tasks', $data);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testUpdate()
    {
        $data = $this->getJsonFixture('update_task_request.json');

        $response = $this->actingAs($this->admin)->json('put', '/tasks/1', $data);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testUpdateNotExists()
    {
        $data = $this->getJsonFixture('update_task_request.json');

        $response = $this->actingAs($this->admin)->json('put', '/tasks/0', $data);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testUpdateNoAuth()
    {
        $data = $this->getJsonFixture('update_task_request.json');

        $response = $this->json('put', '/tasks/1', $data);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testDelete()
    {
        $response = $this->actingAs($this->admin)->json('delete', '/tasks/1');

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('tasks', [
            'id' => 1,
            'deleted_at' => null,
        ]);
    }

    public function testDeleteNotExists()
    {
        $response = $this->actingAs($this->admin)->json('delete', '/tasks/0');

        $response->assertStatus(Response::HTTP_NOT_FOUND);

        $this->assertDatabaseMissing('tasks', [
            'id' => 0
        ]);
    }

    public function testDeleteNoAuth()
    {
        $response = $this->json('delete', '/tasks/1');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testGet()
    {
        $response = $this->actingAs($this->admin)->json('get', '/tasks/1', [
            'with' => ['labels', 'user', 'project'],
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEqualsFixture('get_task.json', $response->json());
    }

    public function testGetNotExists()
    {
        $response = $this->actingAs($this->admin)->json('get', '/tasks/0');

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
                'filter' => ['query' => 'project'],
                'result' => 'search_by_query.json'
            ],
            [
                'filter' => [
                    'project_id' => 1,
                    'with' => ['project', 'labels', 'user'],
                ],
                'result' => 'search_project_id.json'
            ],
            [
                'filter' => ['user_id' => 2],
                'result' => 'search_user_id.json'
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
        $response = $this->actingAs($this->admin)->json('get', '/tasks', $filter);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEqualsFixture($fixture, $response->json());
    }

}
