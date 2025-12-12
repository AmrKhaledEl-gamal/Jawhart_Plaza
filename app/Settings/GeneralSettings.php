<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name;
    public string $site_meta_description;
    public string $site_meta_keywords;
    public string $site_meta_author;

    public string $address;


    public string $phone_number;
    public string $email;

    public string $facebook;
    public string $instagram;
    public string $whatsapp;

    public ?string $site_logo;
    public ?string $site_favicon;

    public static function group(): string
    {
        return 'general';
    }
}
