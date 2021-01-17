<?php


namespace Tests\Unit;


use App\Exceptions\DocumentType\DocumentTypeNotFoundException;
use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\DocumentType\DocumentTypeModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Models\Nmbrs\DocumentModel;
use App\Src\Repositories\Hyper\DocumentType\IDocumentTypeRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Repositories\Nmbrs\Upload\IUploadRepository;
use App\Src\Services\Nmbrs\Upload\DocumentNmbrsService;
use Tests\TestCase;
use Mockery as m;

class DocumentNmbrsServiceTest extends TestCase
{
    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @var IUserRepository
     */
    private $userRepositoryNotFound;

    /**
     * @var IUploadRepository
     */
    private $uploadRepository;

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var DocumentModel
     */
    private $documentModel;

    /**
     * @var DocumentModel
     */
    private $documentModelNtFoundUserId;

    /**
     * @var AddressModel
     */
    private $addressModel;

    /**
     * @var EmergencyContactModel
     */
    private $emergencyContactModel;

    /**
     * @var DocumentTypeModel
     */
    private $documentTypeModel;

    /**
     * @var IDocumentTypeRepository
     */
    private $documentTypeRepository;

    /**
     * @var IDocumentTypeRepository
     */
    private $documentTypeRepositoryNotFound;

    public function setUp(): void
    {
        $this->userModel = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getNmbrsId')
                ->andReturn(1);

            $mock->shouldReceive('getAlias')
                ->andReturn('rvw');

            $mock->shouldReceive('getInitials')
                ->andReturn('r');

            $mock->shouldReceive('getFirstName')
                ->andReturn('Ricky');

            $mock->shouldReceive('getInsertion')
                ->andReturn('van');

            $mock->shouldReceive('getLastname')
                ->andReturn('Waas');

            $mock->shouldReceive('getPhone')
                ->andReturn('061234567');

            $mock->shouldReceive('isHasDriversLicense')
                ->andReturn(true);

            $mock->shouldReceive('getDateOfBirth')
                ->andReturn('2019-01-01');

            $mock->shouldReceive('getCountryOfBirthId')
                ->andReturn(1);

            $mock->shouldReceive('getNationalityId')
                ->andReturn(1);

            $mock->shouldReceive('getMaritalStatusId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('2019-01-01');

            $mock->shouldReceive('getPassword')
                ->andReturn('123456');

            $mock->shouldReceive('isActive')
                ->andReturn(true);

            $mock->shouldReceive('getAddress')
                ->andReturn($this->addressModel);

            $mock->shouldReceive('getEmergencyContact')
                ->andReturn($this->emergencyContactModel);

            $mock->shouldReceive('setAddress')
                ->with(AddressModel::class)
                ->andReturn($mock);

            $mock->shouldReceive('setEmergencyContact')
                ->with(EmergencyContactModel::class)
                ->andReturn($mock);
        });
        $this->documentModel = m::mock(DocumentModel::class, function ($mock) {
            $mock->shouldReceive('getEmployeeId')
                ->andReturn(4);

            $mock->shouldReceive('getDocumentName')
                ->andReturn('document naam');

            $mock->shouldReceive('getBody')
                ->andReturn('document_string');

            $mock->shouldReceive('getGuid')
                ->andReturn('guid-string');

            $mock->shouldReceive('setGuid')
                ->andReturn($mock);

            $mock->shouldReceive('getDocumentType')
                ->andReturn('cv');

            $mock->shouldReceive('setEmployeeId')
                ->andReturn($mock);

            $mock->shouldReceive('getUserId')
                ->andReturn(1);
        });
        $this->documentModelNtFoundUserId = m::mock(DocumentModel::class, function ($mock) {
            $mock->shouldReceive('getEmployeeId')
                ->andReturn(4);

            $mock->shouldReceive('getDocumentName')
                ->andReturn('document naam');

            $mock->shouldReceive('getBody')
                ->andReturn('document_string');

            $mock->shouldReceive('getGuid')
                ->andReturn('guid-string');

            $mock->shouldReceive('setGuid')
                ->andReturn($mock);

            $mock->shouldReceive('getDocumentType')
                ->andReturn('cv');

            $mock->shouldReceive('setEmployeeId')
                ->andReturn($mock);

            $mock->shouldReceive('getUserId')
                ->andReturn(0);
        });

        $this->documentTypeModel = m::mock(DocumentTypeModel::class, function ($mock) {
            $mock->shouldReceive('getDocumentType')
                ->andReturn('guid-string');
        });

        $this->userRepository = m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn($this->userModel);
        });

        $this->userRepositoryNotFound = m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(0);
        });

        $this->uploadRepository = m::mock(IUploadRepository::class, function ($mock) {
            $mock->shouldReceive('upload')
                ->with($this->documentModel)
                ->andReturn();
        });

        $this->documentTypeRepository = m::mock(IDocumentTypeRepository::class, function ($mock) {
            $mock->shouldReceive('findByName')
                ->with('cv')
                ->andReturn($this->documentTypeModel);
        });

        $this->documentTypeRepositoryNotFound = m::mock(IDocumentTypeRepository::class, function ($mock) {
            $mock->shouldReceive('findByName')
                ->with('cv');
        });


        parent::setUp(); // TODO: Change the autogenerated stub
        return;
    }

    public function testUploadDocumentToNmbrs()
    {
        $service = new DocumentNmbrsService(
            $this->uploadRepository,
            $this->userRepository,
            $this->documentTypeRepository
        );
        $service->upload($this->documentModel);
    }

    public function testUploadDocumentToNmbrsEmployeeNotFound()
    {
        $this->expectException(EmployeeNotFoundException::class);

        $service = new DocumentNmbrsService(
            $this->uploadRepository,
            $this->userRepositoryNotFound,
            $this->documentTypeRepository
        );
        $service->upload($this->documentModel);
    }

    public function testUploadDocumentToNmbrsDocumentTypeNotFound()
    {
        $this->expectException(DocumentTypeNotFoundException::class);
        $service = new DocumentNmbrsService(
            $this->uploadRepository,
            $this->userRepository,
            $this->documentTypeRepositoryNotFound
        );
        $service->upload($this->documentModel);
    }

}
