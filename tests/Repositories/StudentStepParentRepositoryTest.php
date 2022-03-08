<?php namespace Tests\Repositories;

use App\Models\StudentStepParent;
use App\Repositories\StudentStepParentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StudentStepParentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StudentStepParentRepository
     */
    protected $studentStepParentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->studentStepParentRepo = \App::make(StudentStepParentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_student_step_parent()
    {
        $studentStepParent = StudentStepParent::factory()->make()->toArray();

        $createdStudentStepParent = $this->studentStepParentRepo->create($studentStepParent);

        $createdStudentStepParent = $createdStudentStepParent->toArray();
        $this->assertArrayHasKey('id', $createdStudentStepParent);
        $this->assertNotNull($createdStudentStepParent['id'], 'Created StudentStepParent must have id specified');
        $this->assertNotNull(StudentStepParent::find($createdStudentStepParent['id']), 'StudentStepParent with given id must be in DB');
        $this->assertModelData($studentStepParent, $createdStudentStepParent);
    }

    /**
     * @test read
     */
    public function test_read_student_step_parent()
    {
        $studentStepParent = StudentStepParent::factory()->create();

        $dbStudentStepParent = $this->studentStepParentRepo->find($studentStepParent->id);

        $dbStudentStepParent = $dbStudentStepParent->toArray();
        $this->assertModelData($studentStepParent->toArray(), $dbStudentStepParent);
    }

    /**
     * @test update
     */
    public function test_update_student_step_parent()
    {
        $studentStepParent = StudentStepParent::factory()->create();
        $fakeStudentStepParent = StudentStepParent::factory()->make()->toArray();

        $updatedStudentStepParent = $this->studentStepParentRepo->update($fakeStudentStepParent, $studentStepParent->id);

        $this->assertModelData($fakeStudentStepParent, $updatedStudentStepParent->toArray());
        $dbStudentStepParent = $this->studentStepParentRepo->find($studentStepParent->id);
        $this->assertModelData($fakeStudentStepParent, $dbStudentStepParent->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_student_step_parent()
    {
        $studentStepParent = StudentStepParent::factory()->create();

        $resp = $this->studentStepParentRepo->delete($studentStepParent->id);

        $this->assertTrue($resp);
        $this->assertNull(StudentStepParent::find($studentStepParent->id), 'StudentStepParent should not exist in DB');
    }
}
