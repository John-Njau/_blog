<x-layout>
    <section class="px-6 py-8" >
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">
                Register!
            </h1>
            <form action="/register" method="post" class="mt-10">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="username"
                    >
                        Name
                    </label>

                    <input type="text" class="border border-gray-400 p-2 w-full"
                           name="name"
                           id="name"
                           placeholder="Your user Name"
                           required
                    >

                    @error('')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                    for="username"
                    >
                        Username
                    </label>

                    <input type="text" class="border border-gray-400 p-2 w-full"
                    name="username"
                    id="username"
                    placeholder="Your Name"
                    required
                    >

                    @error('')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                    @enderror

                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                    for="email"
                    >
                        Email Address
                    </label>

                    <input type="email" class="border border-gray-400 p-2 w-full"
                    name="email"
                    id="email"
                    placeholder="Your Email Address"
                    required
                    >

                    @error('')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                    @enderror

                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                    for="password"
                    >
                        Password
                    </label>

                    <input type="password" class="border border-gray-400 p-2 w-full"
                    name="password"
                    id="password"
                    placeholder="Your Password"
                    required
                    >

                    @error('')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                    @enderror

                </div>
                <div class="mb-6">
                    <button type="submit"
                    class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
Submit
                    </button>
                </div>

            </form>

        </main>
    </section>
</x-layout>
