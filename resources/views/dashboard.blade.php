<x-layout>
    <body class="bg-gray-50" style="position: relative; width: 1280px; height: 800px; background: #FFFFFF; overflow: hidden;">
        <div id="app" class="flex min-h-screen">
            <Dashboard></Dashboard>
        </div>

        <!-- Include Remix Icons -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <!-- Include Raleway font -->
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Raleway', sans-serif;
            }
        </style>
        
        @vite(['resources/js/app.js'])
    </body>
</x-layout>