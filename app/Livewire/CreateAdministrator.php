<?php
declare(strict_types=1);
namespace App\Livewire;

class CreateAdministrator extends CreateUser
{
    /**
     * @var string
     */
    public string $role = 'administrator';

    /**
     * @var string
     */
    protected string $backRoute = 'administrators.list';

    /**
     * @var string
     */
    protected string $view = 'livewire.create-user';
}
