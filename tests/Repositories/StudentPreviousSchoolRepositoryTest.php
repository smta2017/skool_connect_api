<?php namespace Tests\Repositories;

use App\Models\StudentPreviousSchool;
use App\Repositories\StudentPreviousSchoolRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StudentPreviousSchoolRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StudentPreviousSchoolRepository
     */
    protected $studentPreviousSchoolRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->studentPreviousSchoolRepo = \App::make(StudentPreviousSchoolRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_student_previous_school()
    {
        $studentPreviousSchool = StudentPreviousSchool::factory()->make()->toArray();

        $createdStudentPreviousSchool = $this->studentPreviousSchoolRepo->create($studentPreviousSchool);

        $createdStudentPreviousSchool = $createdStudentPreviousSchool->toArray();
        $this->assertArrayHasKey('id', $createdStudentPreviousSchool);
        $this->assertNotNull($createdStudentPreviousSchool['id'], 'Created StudentPreviousSchool must have id specified');
        $this->assertNotNull(StudentPreviousSchool::find($createdStudentPreviousSchool['id']), 'StudentPreviousSchool with given id must be in DB');
        $this->assertModelData($studentPreviousSchool, $createdStudentPreviousSchool);
    }

    /**
     * @test read
     */
    public function test_read_student_previous_school()
    {
        $studentPreviousSchool = StudentPreviousSchool::factory()->create();

        $dbStudentPreviousSchool = $this->studentPreviousSchoolRepo->find($studentPreviousSchool->id);

        $dbStudentPreviousSchool = $dbStudentPreviousSchool->toArray();
        $this->assertModelData($studentPreviousSchool->toArray(), $dbStudentPreviousSchool);
    }

    /**
     * @test update
     */
    public function test_update_student_previous_school()
    {
        $studentPreviousSchool = StudentPreviousSchool::factory()->create();
        $fakeStudentPreviousSchool = StudentPreviousSchool::factory()->make()->toArray();

        $updatedStudentPreviousSchool = $this->studentPreviousSchoolRepo->update($fakeStudentPreviousSchool, $studentPreviousSchool->id);

        $this->assertModelData($fakeStudentPreviousSchool, $updatedStudentPreviousSchool->toArray());
        $dbStudentPreviousSchool = $this->studentPreviousSchoolRepo->find($studentPreviousSchool->id);
        $this->assertModelData($fakeStudentPreviousSchool, $dbStudentPreviousSchool->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_student_previous_school()
    {
        $studentPreviousSchool = StudentPreviousSchool::factory()->create();

        $resp = $this->studentPreviousSchoolRepo->delete($studentPreviousSchool->id);

        $this->assertTrue($resp);
        $this->assertNull(StudentPreviousSchool::find($studentPreviousSchool->id), 'StudentPreviousSchool should not exist in DB');
    }
}
