<?php

namespace Tests\Unit\Services;

use App\Infra\Repositories\BookOutputRepository;
use App\Infra\Repositories\BookRepository;
use App\Models\Book;
use App\Models\BookOutput;
use App\Models\User;
use App\Services\BookOutputService;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class BookOutputServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->service = (new BookOutputService(
            app(abstract: BookOutputRepository::class),
            app(abstract: BookRepository::class),
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

        BookOutput::factory()->count(2)->create();
        $response = $this->service->findPaginate($data);

        $this->assertEquals(
            expected: $expected_count,
            actual: $response->total()
        );
    }

    public function testGetItem_WithValidId_ShouldExpectedResponse(): void
    {
        $object = BookOutput::factory()->create();
        $response = $this->service->findById($object->id);

        $this->assertEquals(
            expected: $object->book_id,
            actual: $response->book_id
        );
        $this->assertEquals(
            expected: $object->value,
            actual: $response->value
        );
    }

    public function testStore_WithValidData_ShouldExpectedSuccessfulResponse(): void
    {
        $expected_identification = 'J12304222';
        $expected_name = 'Jorge Belo Gomes';
        $data = [
            'name' => $expected_name,
            'identification' => $expected_identification,
            'return_date' => now()->addDays(value: 10),
            'book_id' => Book::factory()->create()->id
        ];

        $this->actingAs(User::factory()->create());
        $response = $this->service->save($data);

        $this->assertEquals(
            expected: $expected_identification,
            actual: $response->identification
        );
        $this->assertEquals(
            expected: $expected_name,
            actual: $response->name
        );
    }

    public function testUpdate_WithValidData_ShouldExpectedSuccessfulResponse(): void
    {
        $expected_identification = 'A1029292';
        $data = [
            'identification' => $expected_identification
        ];

        $model = BookOutput::factory()->create(['identification' => 'A1029292']);
        $response = $this->service->update($model->id, $data);

        $this->assertEquals(
            expected: $expected_identification,
            actual: $response->identification
        );
    }

    public function testDelete_WhenValidObject_ShouldExpectedSuccessfulResponse(): void
    {
        $model = BookOutput::factory()->create();
        $response = $this->service->delete($model->id);

        $this->assertTrue($response);
        $this->assertEmpty($this->service->findPaginate([]));
    }
}