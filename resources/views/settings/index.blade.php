<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800  leading-tight">
            {{ __('Application Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div
                            class="mb-4 p-4 bg-green-100 dark:bg-green-700 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div x-data="{ activeTab: '{{ $tabs->first()->tab_slug ?? '' }}' }">
                        <!-- Tabs Navigation -->
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                                @foreach ($tabs as $tab)
                                    <li class="mr-2">
                                        <a href="#" @click.prevent="activeTab = '{{ $tab->tab_slug }}'"
                                            :class="{
                                                'inline-block p-4 border-b-2 rounded-t-lg': true,
                                                'border-indigo-500 text-indigo-600 dark:text-indigo-400 dark:border-indigo-400': activeTab === '{{ $tab->tab_slug }}',
                                                'border-transparent hover:text-gray-600 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700': activeTab !== '{{ $tab->tab_slug }}'
                                            }">
                                            {{ $tab->tab_display_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Tabs Content -->
                        <form method="POST" action="{{ route('settings.store') }}">
                            @csrf
                            @foreach ($tabs as $tab)
                                <div x-show="activeTab === '{{ $tab->tab_slug }}'" class="space-y-6">
                                    @if (isset($settings[$tab->tab_slug]))
                                        @foreach ($settings[$tab->tab_slug] as $setting)
                                            <div>
                                                <label for="{{ $setting->field_key }}"
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                    {{ $setting->field_label }}
                                                </label>
                                                @if ($setting->field_type === 'textarea')
                                                    <textarea id="{{ $setting->field_key }}" name="{{ $setting->field_key }}" rows="3"
                                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm"
                                                        placeholder="{{ $setting->placeholder }}">{{ old($setting->field_key, $setting->field_value ?? '') }}</textarea>
                                                @else
                                                    <input type="{{ $setting->field_type }}"
                                                        id="{{ $setting->field_key }}"
                                                        name="{{ $setting->field_key }}"
                                                        value="{{ old($setting->field_key, $setting->field_value ?? '') }}"
                                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm"
                                                        placeholder="{{ $setting->placeholder }}">
                                                @endif
                                                @if ($setting->hint)
                                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $setting->hint }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No settings configured for this tab yet.</p>
                                    @endif
                                </div>
                            @endforeach

                            <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                        Save Settings
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
