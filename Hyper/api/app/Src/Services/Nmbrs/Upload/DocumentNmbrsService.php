<?php


namespace App\Src\Services\Nmbrs\Upload;

use App\Exceptions\DocumentType\DocumentTypeNotFoundException;
use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Exceptions\Nmbrs\NmbrsEmployeeNotFound;
use App\Http\Requests\Upload\DocumentRequest;
use App\Src\Models\Nmbrs\DocumentModel;
use App\Src\Repositories\Hyper\DocumentType\IDocumentTypeRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Repositories\Nmbrs\Upload\IUploadRepository;

class DocumentNmbrsService implements IDocumentNmbrsService
{
    protected $uploadRepository;
    protected $userRepository;
    protected $documentTypeRepository;

    public function __construct(
        IUploadRepository $uploadRepository,
        IUserRepository $userRepository,
        IDocumentTypeRepository $documentTypeRepository
    ) {
        $this->uploadRepository = $uploadRepository;
        $this->userRepository = $userRepository;
        $this->documentTypeRepository = $documentTypeRepository;
    }

    /**
     * @param DocumentModel $documentModel
     * @throws DocumentTypeNotFoundException
     * @throws EmployeeNotFoundException
     * @throws NmbrsEmployeeNotFound
     */
    public function upload(DocumentModel $documentModel)
    {
        $foundUser = $this->userRepository->findById($documentModel->getUserId());
        $foundDocumentType = $this->documentTypeRepository->findByName($documentModel->getDocumentType());

        if (!$foundUser) {
            throw new EmployeeNotFoundException();
        }
        if (!$foundUser->getNmbrsId()) {
            throw new NmbrsEmployeeNotFound();
        }

        if (!$foundDocumentType) {
            throw new DocumentTypeNotFoundException();
        }
        $updatedDocumentModel = $documentModel->setEmployeeId($foundUser->getNmbrsId());
        $updatedDocumentModel->setGuid($foundDocumentType->getDocumentType());
        $this->uploadRepository->upload($updatedDocumentModel);
    }
}
