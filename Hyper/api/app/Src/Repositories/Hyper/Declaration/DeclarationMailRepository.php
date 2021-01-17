<?php


namespace App\Src\Repositories\Hyper\Declaration;

use App\Mail\Declaration\DeclarationUploadMailable;
use App\Src\Models\Hyper\Declaration\DeclarationModel;
use App\Src\Models\Hyper\User\UserModel;
use Illuminate\Support\Facades\Mail;

class DeclarationMailRepository implements IDeclarationMailRepository
{
    /**
     * @param DeclarationModel $declarationModel
     * @return mixed|void
     */
    public function mail(DeclarationModel $declarationModel)
    {
        Mail::to($declarationModel->getUser()->getEmail())->send(new DeclarationUploadMailable($declarationModel));
    }
}
