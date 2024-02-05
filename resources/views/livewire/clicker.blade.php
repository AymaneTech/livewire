<div class="p-8 max-w-md mx-auto">
    <h1 class="text-3xl font-bold mb-4">Register</h1>

    @if (session('success'))
        <span class="bg-green-700 py-2 w-100">{{ session('success') }}</span>
    @endif

    <form wire:submit="CreateNewUser" class="mb-6">
        <input wire:model="name" type="text" class="border border-gray-400 p-2 rounded-md w-full mb-2"
            placeholder="Name">
        @error('name')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
        <input wire:model="email" type="email" class="border border-gray-400 p-2 rounded-md w-full mb-2"
            placeholder="Email">
        @error('email')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
        <input wire:model="password" type="password" class="border border-gray-400 p-2 rounded-md w-full mb-2"
            placeholder="Password">
        @error('email')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
        <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Create new user</button>
    </form>

    <h1 class="text-3xl font-bold mb-4">All Users</h1>
    <div>
        @foreach ($users as $user)
            <h6 class="text-lg font-semibold">{{ $user->name }}</h6>
        @endforeach
    </div>
    {{ $users->links() }}
</div>
