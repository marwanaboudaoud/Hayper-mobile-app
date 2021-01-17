<?php


namespace App\Src\Repositories\Hyper\Declaration;

use App\Src\Models\Hyper\Declaration\DeclarationModel;
use App\Src\Models\Hyper\User\UserModel;

interface IDeclarationMailRepository
{
    /**
     * @param DeclarationModel $declarationModel
     * @return mixed
     */
    public function mail(DeclarationModel $declarationModel);
}
