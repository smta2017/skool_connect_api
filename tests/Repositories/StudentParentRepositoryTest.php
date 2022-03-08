<?php namespace Tests\Repositories;

use App\Models\StudentParent;
use App\Repositories\StudentParentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StudentParentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StudentParentRepository
     */
    protected $StudentParentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->StudentParentRepo = \App::make(StudentParentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_student_parent()
    {
        $StudentParent = StudentParent::factory()->make()->toArray();

        $createdStudentParent = $this->StudentParentRepo->create($StudentParent);

        $createdStudentParent = $createdStudentParent->toArray();
        $this->assertArrayHasKey('id', $createdStudentParent);
        $this->assertNotNull($createdStudentParent['id'], 'Created StudentParent must have id specified');
        $this->assertNotNull(StudentParent::find($createdStudentParent['id']), 'StudentParent with given id must be in DB');
        $this->assertModelData($StudentParent, $createdStudentParent);
    }

    /**
     * @test read
     */
    public function test_read_student_parent()
    {
        $StudentParent = StudentParent::factory()->create();

        $dbStudentParent = $this->StudentParentRepo->find($StudentParent->id);

        $dbStudentParent = $dbStudentParent->toArray();
        $this->assertModelData($StudentParent->toArray(), $dbStudentParent);
    }

    /**
     * @test update
     */
    public function test_update_student_parent()
    {
        $StudentParent = StudentParent::factory()->create();
        $fakeStudentParent = StudentParent::factory()->make()->toArray();

        $updatedStudentParent = $this->StudentParentRepo->update($fakeStudentParent, $StudentParent->id);

        $this->assertModelData($fakeStudentParent, $updatedStudentParent->toArray());
        $dbStudentParent = $this->StudentParentRepo->find($StudentParent->id);
        $this->assertModelData($fakeStudentParent, $dbStudentParent->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_student_parent()
    {
        $StudentParent = StudentParent::factory()->create();

        $resp = $this->StudentParentRepo->delete($StudentParent->id);

        $this->assertTrue($resp);
        $this->assertNull(StudentParent::find($StudentParent->id), 'StudentParent should not exist in DB');
    }
}
