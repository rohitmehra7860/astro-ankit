<?php

namespace App\Providers;



use Illuminate\Support\ServiceProvider;
use App\Models\SMTPSetting;
use Illuminate\Support\Facades\Config;

class SMTPConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('smtp_settings')) {
                $smtp = SMTPSetting::first();

                if ($smtp) {
                    Config::set('mail.default', $smtp->mailer);
                    Config::set('mail.mailers.smtp.transport', $smtp->mailer);
                    Config::set('mail.mailers.smtp.host', $smtp->host);
                    Config::set('mail.mailers.smtp.port', $smtp->port);
                    Config::set('mail.mailers.smtp.encryption', $smtp->encryption);
                    Config::set('mail.mailers.smtp.username', $smtp->username);
                    Config::set('mail.mailers.smtp.password', $smtp->password);
                    Config::set('mail.from.address', $smtp->from_address);
                    Config::set('mail.from.name', $smtp->from_name);
                }
            }
        } catch (\Throwable $e) {
            // Ignore connection or table-not-found exceptions during console/build stages
        }
    }
}
