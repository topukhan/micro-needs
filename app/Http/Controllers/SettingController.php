<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate; // Add this line

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAppSettings'); // Add this line
        $settings = Setting::all()->groupBy('tab_slug');
        $tabs = Setting::select('tab_slug', 'tab_display_name')->distinct()->get();
        return view('settings.index', compact('settings', 'tabs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('viewAppSettings'); // Add this line
        $inputSettings = $request->except('_token');

        foreach ($inputSettings as $key => $value) {
            $setting = Setting::where('field_key', $key)->first();
            if ($setting) {
                $setting->field_value = $value;
                $setting->save();
                $this->updateEnvFile($key, $value);
            }
        }

        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return redirect()->route('settings.index')->with('success', 'Settings saved successfully.');
    }

    /**
     * Update .env file.
     */
    private function updateEnvFile(string $key, ?string $value)
    {
        $envFilePath = base_path('.env');
        $content = File::get($envFilePath);

        $oldValue = env($key);
        $escapedOldValue = is_bool($oldValue) ? ($oldValue ? 'true' : 'false') : preg_quote($oldValue, '/');


        if (strpos($content, $key . '=') !== false) {
            // Key exists, update it
            if ($value === null || $value === '') {
                 // If new value is null or empty, comment out or remove the line
                $content = preg_replace(
                    "/^{$key}=.*$/m",
                    "#{$key}=",
                    $content
                );
            } else {
                $content = preg_replace(
                    "/^{$key}=.*$/m",
                    "{$key}=\"{$value}\"",
                    $content
                );
            }
        } else {
            // Key does not exist, add it
            if ($value !== null && $value !== '') {
                $content .= "\n{$key}=\"{$value}\"";
            }
        }

        File::put($envFilePath, $content);
    }
}
