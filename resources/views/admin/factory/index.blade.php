<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Factory | Command Center</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

    <nav class="bg-[#021d48] border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <svg class="h-6 w-6 text-[#F15A29]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="text-white text-lg font-bold tracking-tight">ContractorSpecialties <span class="text-[#F15A29]">Factory</span></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold text-gray-900">Master Roster</h1>
                <p class="mt-2 text-sm text-gray-600">Manage all directory profiles, edit brand payloads, and trigger API deployments to standalone servers.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" class="block rounded-md bg-[#F15A29] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F15A29]">
                    Add New Contractor
                </button>
            </div>
        </div>
        
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg bg-white">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Business</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Location</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Brand Engine</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Current Tier</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($contractors as $pro)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="font-medium text-gray-900">{{ $pro->business_name }}</div>
                                        <div class="text-gray-500">{{ $pro->primary_trade }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $pro->city }}, {{ $pro->state }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if($pro->has_brand)
                                            <span class="inline-flex items-center gap-1.5 rounded-full px-2 py-1 text-xs font-medium text-gray-900 ring-1 ring-inset ring-gray-200">
                                                <svg class="h-1.5 w-1.5 fill-green-500" viewBox="0 0 6 6" aria-hidden="true"><circle cx="3" cy="3" r="3" /></svg>
                                                Payload Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 rounded-full px-2 py-1 text-xs font-medium text-gray-500 ring-1 ring-inset ring-gray-200">
                                                <svg class="h-1.5 w-1.5 fill-gray-300" viewBox="0 0 6 6" aria-hidden="true"><circle cx="3" cy="3" r="3" /></svg>
                                                Default Theme
                                            </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium border {{ $pro->tier_color }}">
                                            {{ $pro->tier }}
                                        </span>
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 space-x-3">
                                        <a href="{{ route('admin.factory.edit', $pro->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit Brand</a>
                                        @if(!$pro->has_standalone_site)
                                            <form action="{{ route('admin.factory.deploy', $pro->id) }}" method="POST" class="inline-block m-0 p-0">
                                                @csrf
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to deploy a live site for {{ addslashes($pro->business_name) }}?');" 
                                                        class="text-[#F15A29] hover:text-orange-700 font-bold bg-transparent border-none cursor-pointer">
                                                    Deploy Site
                                                </button>
                                            </form>
                                        @else
                                            <a href="https://{{ $pro->standalone_domain ?? '#' }}" target="_blank" class="text-green-600 hover:text-green-900">View Site</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        @if($contractors->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-sm text-gray-500">No contractors found. Fire another tracer bullet.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>