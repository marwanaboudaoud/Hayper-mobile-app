<?php


namespace App\Src\Services\Hyper\Project;

interface IProjectDeleteService
{
    /**
     * @param  int $id
     * @return bool
     */
    public function delete(int $id);
}
