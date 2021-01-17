<?php


namespace App\Src\Services\Hyper\Declaration;

use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Src\Mappers\Hyper\Declaration\DeclarationModelMapper;
use App\Src\Models\Hyper\Declaration\DeclarationModel;
use App\Src\Repositories\Hyper\Declaration\IDeclarationMailRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;

class DeclarationUploadService implements IDeclarationUploadService
{
    /**
     * @var IDeclarationMailRepository
     */
    private $declarationMailRepository;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    public function __construct(IDeclarationMailRepository $declarationMailRepository, IUserRepository $userRepository)
    {
        $this->declarationMailRepository = $declarationMailRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param DeclarationModel $declarationModel
     * @return mixed|void
     * @throws EmployeeNotFoundException
     */
    public function upload(DeclarationModel $declarationModel)
    {
        $foundUser = $this->userRepository->findByApiToken($declarationModel->getToken());
        if (!$foundUser) {
            throw new EmployeeNotFoundException();
        }
        $declarationModel->setUser($foundUser);

        $this->declarationMailRepository->mail($declarationModel);
    }
}
