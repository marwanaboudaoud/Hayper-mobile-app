<?php

namespace App\Exceptions\Project;

use Exception;
use Throwable;

class ProjectAttachedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Project is attached', 409);
    }
}
