<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                    <p class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">{{ session('success') }}</p>
                    @endif
                    @if(session('error'))
                    <p class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">{{ session('error') }}</p>
                    @endif
                    <table class="w-full border-collapse text-left">
                        <tr>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Rôle</th>
                            <th class="p-3">Action</th>
                        </tr>
                        @foreach($users AS $user)
                            <tr class="border-b">
                                <td class="p-3">{{ $user->name }}</td>
                                <td class="p-3">{{ $user->email }}</td>
                                <td class="p-3">
                                    @if(auth()->id() == $user->id)
                                        <span>{{ ucfirst($user->roles->first()->name) }}</span>
                                    @else 

                                    <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                                        @csrf 
                                        @method('PUT')
                                        <select name="role" id="" class="border rounded px-3 py-1 w-full" onchange="this.form.submit()">
                                            <option value="" disabled {{ $user->roles->isEmpty() ? 'selected' : '' }} >Aucun rôle</option>
                                            @foreach($roles AS $role)
                                                <option value="{{$role->name}}" @if($user->hasRole($role->name)) selected  @endif >{{ ucfirst($role->name) }}</option>
                                            @endforeach
                                        </select>
                                    </form>

                                    @endif
                                </td>
                                <td class="p-3">
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" onclick="return(confirm('Etes vous sur ?'))" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>