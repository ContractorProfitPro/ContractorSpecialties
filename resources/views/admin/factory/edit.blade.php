<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Brand | {{ $contractor->business_name }}</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

    <nav class="bg-[#021d48] border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.factory.index') }}" class="text-white hover:text-[#F15A29]">&larr; Back to Roster</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <form action="{{ route('admin.factory.update', $contractor->id) }}" method="POST">
                @csrf 
                
                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-xl font-bold leading-7 text-gray-900">Brand Engine Setup</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Configure the JSON payload for <strong>{{ $contractor->business_name }}</strong>. This immediately upgrades them to the Premium tier.</p>

                    <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 border-t border-gray-200 pt-8">
                        
                        <div class="sm:col-span-6">
                            <h3 class="text-sm font-semibold text-gray-900 bg-gray-50 p-2 rounded">Color Palette (Hex)</h3>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Primary Brand Color</label>
                            <div class="mt-2 flex items-center gap-3">
                                <input type="color" name="color_primary" value="{{ $brand['colors']['primary'] ?? '#021d48' }}" class="h-8 w-14 p-0 border-0 rounded cursor-pointer">
                                <span class="text-sm text-gray-500">Headers, Hero Backgrounds</span>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Secondary Accent Color</label>
                            <div class="mt-2 flex items-center gap-3">
                                <input type="color" name="color_secondary" value="{{ $brand['colors']['secondary'] ?? '#F15A29' }}" class="h-8 w-14 p-0 border-0 rounded cursor-pointer">
                                <span class="text-sm text-gray-500">Buttons, Links, Borders</span>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Surface / Background</label>
                            <div class="mt-2 flex items-center gap-3">
                                <input type="color" name="color_surface" value="{{ $brand['colors']['surface'] ?? '#f9fafb' }}" class="h-8 w-14 p-0 border-0 rounded cursor-pointer">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Base Text Color</label>
                            <div class="mt-2 flex items-center gap-3">
                                <input type="color" name="color_text" value="{{ $brand['colors']['text'] ?? '#4A4E55' }}" class="h-8 w-14 p-0 border-0 rounded cursor-pointer">
                            </div>
                        </div>

                        <div class="sm:col-span-6 mt-4">
                            <h3 class="text-sm font-semibold text-gray-900 bg-gray-50 p-2 rounded">Typography (Google Fonts)</h3>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Heading Font</label>
                            <input type="text" name="font_heading" value="{{ $brand['fonts']['heading'] ?? 'Inter' }}" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 px-3 focus:ring-2 focus:ring-[#F15A29] sm:text-sm sm:leading-6">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Display Font (Initials)</label>
                            <input type="text" name="font_display" value="{{ $brand['fonts']['display'] ?? 'Inter' }}" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 px-3 focus:ring-2 focus:ring-[#F15A29] sm:text-sm sm:leading-6">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Body Font</label>
                            <input type="text" name="font_body" value="{{ $brand['fonts']['body'] ?? 'Inter' }}" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 px-3 focus:ring-2 focus:ring-[#F15A29] sm:text-sm sm:leading-6">
                        </div>

                    </div>
                </div>
                
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8 bg-gray-50">
                    <a href="{{ route('admin.factory.index') }}" class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-600">Cancel</a>
                    <button type="submit" class="rounded-md bg-[#021d48] px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Save JSON Payload</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>