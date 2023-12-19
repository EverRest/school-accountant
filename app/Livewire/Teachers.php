<?php
declare(strict_types=1);
namespace App\Livewire;

class Teachers extends Users
{
    /**
     * @var string
     */
    public string $createUrl = 'teachers/create';

    /**
     * @var string
     */
    protected string $role = 'teacher';
}
