<?php

namespace Tests\Unit\Services;

use App\Infra\Repositories\GenderRepository;
use App\Models\Gender;
use App\Services\GenderService;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class GenderServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->service = (new GenderService(app(GenderRepository::class)));
        parent::setUp();
    }

    public function testGetData_WhenDataNotFound_ShouldExpectedEmptyResponse(): void
    {
        $data = [];
        $response = $this->service->findPaginate($data);
        $this->assertEmpty($response);
    }

    public function testGetData_WithData_ShouldExpectedTwoItemsResponse(): void
    {
        $expected_count = 2;
        $data = [];

        Gender::factory()->count(2)->create();
        $response = $this->service->findPaginate($data);

        $this->assertEquals(
            expected: $expected_count,
            actual: $response->total()
        );
    }

    public function testGetAll_WithoutFilters_ShouldExpectedCount(): void
    {
        $expected_count = 2;
        $data = [];

        Gender::factory()->count(2)->create();
        $response = $this->service->findAll($data);

        $this->assertCount(
            expectedCount: $expected_count,
            haystack: $response
        );
    }

    public function testGetEnabled_WhenFindEnabledAllCalled_ShouldExpectedCount(): void
    {
        $expected_count = 2;

        Gender::factory()->count(2)->create(['enabled' => true]);
        Gender::factory()->count(5)->create(['enabled' => false]);
        $response = $this->service->findEnabledAll();

        $this->assertCount(
            expectedCount: $expected_count,
            haystack: $response
        );
    }

    public function testGetItem_WithValidId_ShouldExpectedResponse(): void
    {
        $object = Gender::factory()->create();
        $response = $this->service->findById($object->id);

        $this->assertEquals(
            expected: $object->name,
            actual: $response->name
        );
    }

    public function testStore_WithValidData_ShouldExpectedSuccessfulResponse(): void
    {
        $expected_name = 'Romance';
        $data = [
            'name' => $expected_name,
            'active' => true
        ];

        $response = $this->service->save($data);

        $this->assertEquals(
            expected: $expected_name,
            actual: $response->name
        );
    }

    public function testUpdate_WithValidData_ShouldExpectedSuccessfulResponse(): void
    {
        $expected_name = 'Romance';
        $data = [
            'name' => $expected_name,
        ];

        $model = Gender::factory()->create(['name' => 'ROMANCE']);
        $response = $this->service->update($model->id, $data);

        $this->assertEquals(
            expected: $expected_name,
            actual: $response->name
        );
    }

    public function testDelete_WhenValidObject_ShouldExpectedSuccessfulResponse(): void
    {
        $model = Gender::factory()->create();
        $response = $this->service->delete($model->id);

        $this->assertTrue($response);
        $this->assertEmpty($this->service->findPaginate([]));
    }
}