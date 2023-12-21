<?php
declare(strict_types=1);
namespace App\Livewire;

class CreateStudent extends CreateUser
{
    /**
     * @var string
     */
    public string $role = 'student';

    /**
     * @var string
     */
    protected string $backRoute = 'students.list';
}
