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
    protected $studentParentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->studentParentRepo = \App::make(StudentParentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_student_parent()
    {
        $studentParent = StudentParent::factory()->make()->toArray();

        $createdStudentParent = $this->studentParentRepo->create($studentParent);

        $createdStudentParent = $createdStudentParent->toArray();
        $this->assertArrayHasKey('id', $createdStudentParent);
        $this->assertNotNull($createdStudentParent['id'], 'Created StudentParent must have id specified');
        $this->assertNotNull(StudentParent::find($createdStudentParent['id']), 'StudentParent with given id must be in DB');
        $this->assertModelData($studentParent, $createdStudentParent);
    }

    /**
     * @test read
     */
    public function test_read_student_parent()
    {
        $studentParent = StudentParent::factory()->create();

        $dbStudentParent = $this->studentParentRepo->find($studentParent->id);

        $dbStudentParent = $dbStudentParent->toArray();
        $this->assertModelData($studentParent->toArray(), $dbStudentParent);
    }

    /**
     * @test update
     */
    public function test_update_student_parent()
    {
        $studentParent = StudentParent::factory()->create();
        $fakeStudentParent = StudentParent::factory()->make()->toArray();

        $updatedStudentParent = $this->studentParentRepo->update($fakeStudentParent, $studentParent->id);

        $this->assertModelData($fakeStudentParent, $updatedStudentParent->toArray());
        $dbStudentParent = $this->studentParentRepo->find($studentParent->id);
        $this->assertModelData($fakeStudentParent, $dbStudentParent->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_student_parent()
    {
        $studentParent = StudentParent::factory()->create();

        $resp = $this->studentParentRepo->delete($studentParent->id);

        $this->assertTrue($resp);
        $this->assertNull(StudentParent::find($studentParent->id), 'StudentParent should not exist in DB');
    }
}
