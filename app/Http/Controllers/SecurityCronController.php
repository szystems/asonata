<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SecurityCronController extends Controller
{
    public function scan(Request $request)
    {
        $token = env('SECURITY_CRON_TOKEN');

        if (!$token || $request->get('token') !== $token) {
            abort(403);
        }

        try {
            Artisan::call('security:scan-php');
            $output = trim(Artisan::output());
        } catch (\Throwable $e) {
            return response('ERROR: ' . $e->getMessage(), 500)
                ->header('Content-Type', 'text/plain');
        }

        return response('OK: ' . $output, 200)
            ->header('Content-Type', 'text/plain');
    }
}
