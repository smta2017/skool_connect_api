<?php namespace Tests\Repositories;

use App\Models\StParent;
use App\Repositories\ParentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ParentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ParentRepository
     */
    protected $parentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->parentRepo = \App::make(ParentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_parent()
    {
        $parent = StParent::factory()->make()->toArray();

        $createdParent = $this->parentRepo->create($parent);

        $createdParent = $createdParent->toArray();
        $this->assertArrayHasKey('id', $createdParent);
        $this->assertNotNull($createdParent['id'], 'Created Parent must have id specified');
        $this->assertNotNull(StParent::find($createdParent['id']), 'Parent with given id must be in DB');
        $this->assertModelData($parent, $createdParent);
    }

    /**
     * @test read
     */
    public function test_read_parent()
    {
        $parent = StParent::factory()->create();

        $dbParent = $this->parentRepo->find($parent->id);

        $dbParent = $dbParent->toArray();
        $this->assertModelData($parent->toArray(), $dbParent);
    }

    /**
     * @test update
     */
    public function test_update_parent()
    {
        $parent = StParent::factory()->create();
        $fakeParent = StParent::factory()->make()->toArray();

        $updatedParent = $this->parentRepo->update($fakeParent, $parent->id);

        $this->assertModelData($fakeParent, $updatedParent->toArray());
        $dbParent = $this->parentRepo->find($parent->id);
        $this->assertModelData($fakeParent, $dbParent->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_parent()
    {
        $parent = StParent::factory()->create();

        $resp = $this->parentRepo->delete($parent->id);

        $this->assertTrue($resp);
        $this->assertNull(StParent::find($parent->id), 'Parent should not exist in DB');
    }
}
