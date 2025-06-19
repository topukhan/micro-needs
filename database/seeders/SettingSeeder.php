<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'tab_slug' => 'gemini_key',
                'tab_display_name' => 'Gemini Key',
                'field_key' => 'GEMINI_API_KEY',
                'field_label' => 'API Key',
                'field_value' => env('GEMINI_API_KEY', null),
                'field_type' => 'text',
                'placeholder' => 'Enter your Gemini API Key',
                'hint' => 'Your API key for accessing Gemini services.',
            ],
            [
                'tab_slug' => 'stripe_keys',
                'tab_display_name' => 'Stripe Keys',
                'field_key' => 'STRIPE_KEY',
                'field_label' => 'Stripe Key',
                'field_value' => env('STRIPE_KEY', null),
                'field_type' => 'text',
                'placeholder' => 'Enter your Stripe Publishable Key (pk_...)',
                'hint' => 'Your Stripe publishable API key.',
            ],
            [
                'tab_slug' => 'stripe_keys',
                'tab_display_name' => 'Stripe Keys',
                'field_key' => 'STRIPE_SECRET',
                'field_label' => 'Stripe Secret',
                'field_value' => env('STRIPE_SECRET', null),
                'field_type' => 'password',
                'placeholder' => 'Enter your Stripe Secret Key (sk_...)',
                'hint' => 'Your Stripe secret API key. Keep this confidential.',
            ],
            [
                'tab_slug' => 'typesense',
                'tab_display_name' => 'Typesense',
                'field_key' => 'TYPESENSE_API_KEY',
                'field_label' => 'API Key',
                'field_value' => env('TYPESENSE_API_KEY', null),
                'field_type' => 'text',
                'placeholder' => 'Enter your Typesense API Key',
                'hint' => 'Your API key for accessing Typesense services.',
            ],
            [
                'tab_slug' => 'typesense',
                'tab_display_name' => 'Typesense',
                'field_key' => 'TYPESENSE_HOST',
                'field_label' => 'Host',
                'field_value' => env('TYPESENSE_HOST', 'localhost'),
                'field_type' => 'text',
                'placeholder' => 'Enter your Typesense Host',
                'hint' => 'Your Typesense host.',
            ],
            [
                'tab_slug' => 'typesense',
                'tab_display_name' => 'Typesense',
                'field_key' => 'TYPESENSE_PORT',
                'field_label' => 'Port',
                'field_value' => env('TYPESENSE_PORT', '8108'),
                'field_type' => 'text',
                'placeholder' => 'Enter your Typesense Port',
                'hint' => 'The port on which your Typesense server is running.',
            ],
            [
                'tab_slug' => 'typesense',
                'tab_display_name' => 'Typesense',
                'field_key' => 'TYPESENSE_PROTOCOL',
                'field_label' => 'Protocol',
                'field_value' => env('TYPESENSE_PROTOCOL', 'http'),
                'field_type' => 'text',
                'placeholder' => 'Enter your Typesense Protocol',
                'hint' => 'The protocol used to connect to your Typesense server.',
            ],

        ];

        foreach ($settings as $settingData) {
            Setting::updateOrCreate(
                ['field_key' => $settingData['field_key']], // Attributes to find the record
                $settingData // Attributes to update or create
            );
        }
    }
}
