<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        Welcome {{auth()->user()->name}}

        <div class="mx-auto mt-8">
            <p class="ml-2">Name: </p> {{auth()->user()->name}}
        </div>
    </x-card>    

    <x-card class="max-w-lg mx-auto mt-4 p-2 flex space-x-6">
            <a href="/users/{{Auth::user()->id}}/edit">
                <i class="fa-solid fa-pencil"></i>Edit User
            </a>

            <form method="POST" action="/users/{{Auth::user()->id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i>
                    Delete User</button>
            </form>

            <a href="/" class="text-black ml-4"> Back </a>
        </x-card>
</x-layout>