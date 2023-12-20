<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class UpdateGroup extends Component
{
    /**
     * @var ?Group
     */
    public ?Group $group = null;

    /**
     * @var string
     */
    public string $name = '';

    /**
     * @var mixed
     */
    public mixed  $selectedGroup;

    /**
     * @var GroupService|null
     */
    private ?GroupService $groupService;

    public function __construct()
    {
        $this->groupService = new GroupService();
    }

    /**
     * @param Group $group
     *
     * @return void
     */
    public function mount(Group $group): void
    {
        $this->group = $group;
        $this->name = $group->name;
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate(['name' => 'sometimes|string|max:255',]);
        $this->groupService->update($this->group, ['name' => $this->name,'course_id' => $this->selectedGroup->id]);

        session()->flash('message', 'Group successfully updated.');
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.update-group');
    }
}
