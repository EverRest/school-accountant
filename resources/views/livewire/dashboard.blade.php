<div>
    @if(auth()->user())
        <x-header title="Schedule" subtitle="Apply students to the lesson" separator/>
    @endif
    @foreach($lessons as $lesson)
        <x-card title="{{$lesson->name}}">
            <x-badge value="{{$lesson->teacher->name}}" class="badge-primary"/>
            <x-badge value="{{$lesson->group->name}}" class="badge-accent"/>
            <x-badge value="{{$lesson->date}}" class="badge-info"/>
            @if($lesson->studentAttendances)
                @foreach($lesson->studentAttendances as $student)
                    <x-list-item :item="$student->student->user"
                                 link="{{route('users.show', ['user' => $student->student->user_id])}}"/>
                @endforeach
            @endif
            <x-slot:menu>
                <x-button icon="o-share" class="btn-circle btn-sm"/>
                <x-icon name="o-heart" class="cursor-pointer"/>
            </x-slot:menu>
            <x-slot:actions>
                <x-button label="Apply" class="btn-primary"/>
            </x-slot:actions>
        </x-card>
        <hr class="pt-1 pb-1"/>
    @endforeach
</div>
