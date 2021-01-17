<?php

namespace App\Exceptions\Project;

use Exception;
use Throwable;

class ProjectNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Project not found!', 404);
    }
}
