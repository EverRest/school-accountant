<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\Course;
use App\Models\Group;
use App\Services\CourseService;
use App\Services\GroupService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Groups extends Component
{
    use WithPagination;

    /**
     * @var mixed
     */
    public mixed $groups;

    /**
     * @var string
     */
    public string $search = '';

    /**
     * @var array
     */
    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'course', 'label' => 'Course'],
        ['key' => 'creator', 'label' => 'Creator'],
    ];

    /**
     * @var GroupService
     */
    private GroupService $groupService;

    public function __construct()
    {
        $this->groupService = new GroupService();
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->groups = $this->getGroups();
    }

    /**
     * @return void
     */
    public function searchQ(): void
    {
        $q = $this->groupService->query();
        if ($this->search) {
            $this->groups = $q->where('name', 'like', "%$this->search%")
                ->get();
        } else {
            $this->groups = $q->get();
        }
    }

    /**
     * @param Course $course
     *
     * @return void
     * @throws Throwable
     */
    public function delete(Course $course): void
    {
        $this->groupService->destroy($course);
        $this->groups = $this->getGroups();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     */
    public function create(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return redirect('groups/create');
    }

    /**
     * @param Group $group
     *
     * @return void
     */
    public function edit(Group $group): void
    {
        $this->redirectRoute('groups.update', ['group' => $group]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.groups');
    }

    /**
     * @return Collection
     */
    protected function getGroups(): Collection
    {
        return $this->groupService->all()->get();
    }
}
