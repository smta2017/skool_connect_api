<?php namespace Tests\Repositories;

use App\Models\StudentStatus;
use App\Repositories\StudentStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StudentStatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StudentStatusRepository
     */
    protected $studentStatusRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->studentStatusRepo = \App::make(StudentStatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_student_status()
    {
        $studentStatus = StudentStatus::factory()->make()->toArray();

        $createdStudentStatus = $this->studentStatusRepo->create($studentStatus);

        $createdStudentStatus = $createdStudentStatus->toArray();
        $this->assertArrayHasKey('id', $createdStudentStatus);
        $this->assertNotNull($createdStudentStatus['id'], 'Created StudentStatus must have id specified');
        $this->assertNotNull(StudentStatus::find($createdStudentStatus['id']), 'StudentStatus with given id must be in DB');
        $this->assertModelData($studentStatus, $createdStudentStatus);
    }

    /**
     * @test read
     */
    public function test_read_student_status()
    {
        $studentStatus = StudentStatus::factory()->create();

        $dbStudentStatus = $this->studentStatusRepo->find($studentStatus->id);

        $dbStudentStatus = $dbStudentStatus->toArray();
        $this->assertModelData($studentStatus->toArray(), $dbStudentStatus);
    }

    /**
     * @test update
     */
    public function test_update_student_status()
    {
        $studentStatus = StudentStatus::factory()->create();
        $fakeStudentStatus = StudentStatus::factory()->make()->toArray();

        $updatedStudentStatus = $this->studentStatusRepo->update($fakeStudentStatus, $studentStatus->id);

        $this->assertModelData($fakeStudentStatus, $updatedStudentStatus->toArray());
        $dbStudentStatus = $this->studentStatusRepo->find($studentStatus->id);
        $this->assertModelData($fakeStudentStatus, $dbStudentStatus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_student_status()
    {
        $studentStatus = StudentStatus::factory()->create();

        $resp = $this->studentStatusRepo->delete($studentStatus->id);

        $this->assertTrue($resp);
        $this->assertNull(StudentStatus::find($studentStatus->id), 'StudentStatus should not exist in DB');
    }
}
