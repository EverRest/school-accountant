<?php
declare(strict_types=1);
namespace App\Livewire;

class CreateTeacher extends CreateUser
{
    /**
     * @var string
     */
    public string $role = 'teacher';

    /**
     * @var string
     */
    protected string $backRoute = 'teachers.list';
}
