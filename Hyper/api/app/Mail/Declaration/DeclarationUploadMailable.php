<?php

namespace App\Mail\Declaration;

use App\Src\Models\Hyper\Declaration\DeclarationModel;
use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeclarationUploadMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var DeclarationModel
     */
    public $declarationModel;

    /**
     * DeclarationUploadMailable constructor.
     * @param DeclarationModel $declarationModel
     */
    public function __construct(DeclarationModel $declarationModel)
    {
        $this->declarationModel = $declarationModel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailables.declaration')
            ->attach(
                $this->declarationModel->getImage()->file('image'),
                [
                    'as' => $this->declarationModel->getImage()->file('image')->getClientOriginalName(),
                    'mime' => $this->declarationModel->getImage()->file('image')->getClientMimeType()
                ]
            );
    }
}
