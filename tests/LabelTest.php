<?php

namespace App\Tests;

use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class LabelTest extends TestCase
{
    protected $admin;

    public function setUp() : void
    {
        parent::setUp();

        $this->admin = User::find(1);
    }

    public function testCreate()
    {
        $data = $this->getJsonFixture('create_label_request.json');

        $response = $this->actingAs($this->admin)->json('post', '/labels', $data);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEqualsFixture('create_label_response.json', $response->json());

        $this->assertDatabaseHas('labels', $this->getJsonFixture('create_label_response.json'));
    }

    public function testCreateNoAuth()
    {
        $data = $this->getJsonFixture('create_label_request.json');

        $response = $this->json('post', '/labels', $data);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testUpdate()
    {
        $data = $this->getJsonFixture('update_label_request.json');

        $response = $this->actingAs($this->admin)->json('put', '/labels/1', $data);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdateNotExists()
    {
        $data = $this->getJsonFixture('update_label_request.json');

        $response = $this->actingAs($this->admin)->json('put', '/labels/0', $data);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testUpdateNoAuth()
    {
        $data = $this->getJsonFixture('update_label_request.json');

        $response = $this->json('put', '/labels/1', $data);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testDelete()
    {
        $response = $this->actingAs($this->admin)->json('delete', '/labels/1');

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('labels', [
            'id' => 1
        ]);
    }

    public function testDeleteNotExists()
    {
        $response = $this->actingAs($this->admin)->json('delete', '/labels/0');

        $response->assertStatus(Response::HTTP_NOT_FOUND);

        $this->assertDatabaseMissing('labels', [
            'id' => 0
        ]);
    }

    public function testDeleteNoAuth()
    {
        $response = $this->json('delete', '/labels/1');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testGet()
    {
        $response = $this->actingAs($this->admin)->json('get', '/labels/1');

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEqualsFixture('get_label.json', $response->json());
    }

    public function testGetNotExists()
    {
        $response = $this->actingAs($this->admin)->json('get', '/labels/0');

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
                'filter' => ['query' => '2'],
                'result' => 'search_by_query.json'
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
        $response = $this->actingAs($this->admin)->json('get', '/labels', $filter);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEqualsFixture($fixture, $response->json());
    }

}
