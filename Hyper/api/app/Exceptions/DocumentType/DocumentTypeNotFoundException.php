<?php

namespace App\Exceptions\DocumentType;

use Exception;
use Throwable;

class DocumentTypeNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Document type does not exist", 409, null);
    }
}
