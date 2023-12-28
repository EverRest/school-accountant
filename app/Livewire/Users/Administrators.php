<?php
declare(strict_types=1);
namespace App\Livewire\Users;

class Administrators extends Users
{
    /**
     * @var string
     */
    public string $createUrl = 'administrators/create';

    /**
     * @var string
     */
    protected string $role = 'administrator';
}
