<x-layout>
    <x-settings :heading="'Edit User: '. $user->name ">
        <form method="POST" action="/admin/users/{{$user->id}}" >
            @csrf
            @method('PUT')
            <x-form.field>
                <x-form.label name="role"/>
                <select name="role[]" id="roles" multiple
                >
                    @foreach(\App\Models\Role::all() as $role)
                    <option
                        value="{{ $role->id }}" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : ''}}>

                    {{ ucwords($role->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="role"/>
            </x-form.field>
            <x-form.input name="username" :value="old('username', $user->username)"/>


            <x-form.button>Update</x-form.button>
        </form>
    </x-settings>
</x-layout>
