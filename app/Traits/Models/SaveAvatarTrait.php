<?php
declare(strict_types=1);
namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

trait SaveAvatarTrait
{
    use WithFileUploads;

    /**
     * @param Model $model
     * @param mixed $avatar
     *
     * @return Model
     */
    protected function saveAvatar(Model $model, mixed $avatar): Model
    {
        if ($model->avatar) {
            Storage::disk('public')->delete($model->avatar);
        }
        $filename = Carbon::now()->timestamp . '_' . $avatar->getClientOriginalName();
        $filePath = $avatar->storeAs('avatars', $filename, 'public');
        $model->update([
            'avatar' => $filePath
        ]);

        return $model;
    }
}
