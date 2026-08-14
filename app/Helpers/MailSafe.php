<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MailSafe
{
    public static function send($to, $mailable): bool
    {
        if (empty($to)) {
            return false;
        }

        try {
            Mail::to($to)->send($mailable);
            return true;
        } catch (Throwable $e) {
            Log::error('Mail send failed: '.$e->getMessage(), [
                'to' => $to,
                'mailable' => is_object($mailable) ? get_class($mailable) : (string) $mailable,
            ]);

            return false;
        }
    }

    public static function status(string $successMessage, bool $mailOk): string
    {
        if ($mailOk) {
            return $successMessage;
        }

        return $successMessage.' '.__('Automatic mail could not be sent.');
    }
}
