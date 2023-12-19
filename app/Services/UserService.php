<?php
declare(strict_types=1);
namespace App\Services;

use Illuminate\Support\Collection;

class UserService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = 'App\Models\User';

    /**
     * @param string $code
     *
     * @return Collection
     */
    public function getUsersByRoleCode(string $code = ''): Collection
    {
        return $this->model::role($code)->get() ?? Collection::make();
    }

    /**
     * @param string $code
     * @param int $perPage
     *
     * @return mixed
     */
    public function getUsersByRoleCodePaginated(string $code = '', int $perPage = 10): mixed
    {
        return $this->model::role($code)->paginate($perPage);
    }
}
