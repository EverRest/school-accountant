<div>
    @if(auth()->user())
        <x-header title="Schedule" subtitle="Apply students to the lesson" separator/>
    @endif
    @foreach($lessons as $lesson)
        <x-card title="{{$lesson->name}}">
            <x-avatar :image="$lesson->photo" class="!w-24 !rounded-lg">
            </x-avatar>
            @if($lesson->studentAttendances)
                @foreach($lesson->studentAttendances as $student)
                    <x-list-item :item="$student->student->user"
                                 link="{{route('users.show', ['user' => $student->student->user_id])}}"/>
                @endforeach
            @endif
            <x-slot:menu>
                <x-badge value="{{$lesson->teacher?->user?->name ?? ''}}" class="badge-primary"/>
                <x-badge value="{{$lesson->group?->name ?? ''}}" class="badge-accent"/>
                <x-badge value="{{$lesson->date ?? ''}}" class="badge-info"/>
            </x-slot:menu>
            <x-slot:actions>
                <x-button label="Edit" link="{{route('lessons.update', ['lesson' => $lesson])}}" icon="o-pencil"
                          class="btn-accent"/>
                <x-button label="Apply" class="btn-primary" icon="o-check-badge"/>
            </x-slot:actions>
        </x-card>
        <hr class="pt-1 pb-1"/>
    @endforeach
</div>
