<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Site Details and seo
        $this->migrator->add('general.site_name', 'My Site');
        $this->migrator->add('general.site_meta_description', 'My Site Description');
        $this->migrator->add('general.site_meta_keywords', 'My Site Keywords');
        $this->migrator->add('general.site_meta_author', 'My Site Author');

        // Addresses
        $this->migrator->add('general.address', 'My Site Title');

        // Phone Numbers 1, 2
        $this->migrator->add('general.phone_number', '00 0000 0000');

        // Email
        $this->migrator->add('general.email', '0B4D2@example.com');

        // Social Media
        $this->migrator->add('general.facebook', 'https://www.facebook.com');
        $this->migrator->add('general.instagram', 'https://www.instagram.com');
        $this->migrator->add('general.whatsapp', 'https://www.whatsapp.com');


        // Site Logo and Favicon
        $this->migrator->add('general.site_logo', 'logo.png');
        $this->migrator->add('general.site_favicon', 'favicon.png');
    }
};
