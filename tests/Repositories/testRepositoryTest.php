<?php namespace Tests\Repositories;

use App\Models\test;
use App\Repositories\testRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class testRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var testRepository
     */
    protected $testRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->testRepo = \App::make(testRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_test()
    {
        $test = test::factory()->make()->toArray();

        $createdtest = $this->testRepo->create($test);

        $createdtest = $createdtest->toArray();
        $this->assertArrayHasKey('id', $createdtest);
        $this->assertNotNull($createdtest['id'], 'Created test must have id specified');
        $this->assertNotNull(test::find($createdtest['id']), 'test with given id must be in DB');
        $this->assertModelData($test, $createdtest);
    }

    /**
     * @test read
     */
    public function test_read_test()
    {
        $test = test::factory()->create();

        $dbtest = $this->testRepo->find($test->id);

        $dbtest = $dbtest->toArray();
        $this->assertModelData($test->toArray(), $dbtest);
    }

    /**
     * @test update
     */
    public function test_update_test()
    {
        $test = test::factory()->create();
        $faketest = test::factory()->make()->toArray();

        $updatedtest = $this->testRepo->update($faketest, $test->id);

        $this->assertModelData($faketest, $updatedtest->toArray());
        $dbtest = $this->testRepo->find($test->id);
        $this->assertModelData($faketest, $dbtest->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_test()
    {
        $test = test::factory()->create();

        $resp = $this->testRepo->delete($test->id);

        $this->assertTrue($resp);
        $this->assertNull(test::find($test->id), 'test should not exist in DB');
    }
}
