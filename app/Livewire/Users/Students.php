<?php
declare(strict_types=1);
namespace App\Livewire\Users;

class Students extends Users
{
    /**
     * @var string
     */
    public string $createUrl = 'students/create';

    /**
     * @var string
     */
    protected string $role = 'student';
}
