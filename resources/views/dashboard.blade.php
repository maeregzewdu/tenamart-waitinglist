<x-layout>
    <body>
        <!-- You can remove this once you have built the dashboard -->
        <h1>Dashboard</h1>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="text-red-500">Logout</button>
        </form>
        
    </body>
</x-layout>