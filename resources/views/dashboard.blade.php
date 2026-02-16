<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Welcome -->
                <h3 class="text-2xl font-bold mb-4">Welcome back, {{ Auth::user()->name }}!</h3>
                <p>You are logged in.</p>

                <!-- Navigation to Agent/Admin Dashboards -->
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('agent.dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Go to Agent Dashboard</a>
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">Go to Admin Dashboard</a>
                    <a href="{{ route('home') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Go to Home</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
