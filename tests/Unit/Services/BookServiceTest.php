<?php

namespace Tests\Unit\Services;

use App\Infra\Repositories\BookRepository;
use App\Infra\Repositories\BrandRepository;
use App\Infra\Repositories\GenderRepository;
use App\Models\Book;
use App\Models\Brand;
use App\Models\Gender;
use App\Services\BookService;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class BookServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->service = (new BookService(
            app(BookRepository::class),
            app(BrandRepository::class),
            app(GenderRepository::class)
        ));
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

        Book::factory()->count(2)->create();
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

        Book::factory()->count(2)->create();
        $response = $this->service->findAll($data);

        $this->assertCount(
            expectedCount: $expected_count,
            haystack: $response
        );
    }

    public function testGetItem_WithValidId_ShouldExpectedResponse(): void
    {
        $object = Book::factory()->create();
        $response = $this->service->findById($object->id);

        $this->assertEquals(
            expected: $object->name,
            actual: $response->name
        );
    }

    public function testStore_WithValidData_ShouldExpectedSuccessfulResponse(): void
    {
        $expected_name = 'JAVA: COMO PROGRAMAR';
        $data = [
            'name' => $expected_name,
            'brand_id' => Brand::factory()->create()->id,
            'gender_id' => Gender::factory()->create()->id,
            'year' => fake()->numberBetween(1450, 2024),
            'situation' => Book::getSituations()[array_rand(Book::getSituations())]
        ];

        $response = $this->service->save($data);

        $this->assertEquals(
            expected: $expected_name,
            actual: $response->name
        );
    }

    public function testUpdate_WithValidData_ShouldExpectedSuccessfulResponse(): void
    {
        $expected_name = 'PEQUENO PRINCIPEE';
        $data = [
            'name' => $expected_name,
        ];

        $model = Book::factory()->create(['name' => 'PEQUENO PRINCIPE']);
        $response = $this->service->update($model->id, $data);

        $this->assertEquals(
            expected: $expected_name,
            actual: $response->name
        );
    }

    public function testDelete_WhenValidObject_ShouldExpectedSuccessfulResponse(): void
    {
        $model = Book::factory()->create();
        $response = $this->service->delete($model->id);

        $this->assertTrue($response);
        $this->assertEmpty($this->service->findPaginate([]));
    }
}