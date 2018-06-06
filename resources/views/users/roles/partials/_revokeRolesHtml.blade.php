@foreach ($user->roles as $role)


    <div class="checkbox" id="role_id">
        <label>
            <input type="checkbox" class="role_id" name="role_id[]" value="{{ $role->id }}">
            {{ $role->name }}
        </label>
    </div>


@endforeach