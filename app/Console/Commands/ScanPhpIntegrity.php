<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ScanPhpIntegrity extends Command
{
    protected $signature = 'security:scan-php';
    protected $description = 'Escanea public/ en busca de archivos PHP no autorizados y envía alerta por email';

    // Único PHP permitido en la raíz de public/
    protected $allowedFiles = [
        'index.php',
    ];

    // En estos directorios puede haber PHP de templates — solo alertar si son NUEVOS
    protected $trustedDirs = [
        'backend',
        'dashtemplate',
        'fronttemplate',
        'datePicker',
        'assets',
        'frontend',
        'media',
    ];

    // Nombres de archivo maliciosos conocidos (del grupo HaxorWorld/SEO Bawang)
    protected $knownMalicious = [
        'wp-mins.php', 'tiny.php', 'd2.php', 'dista.php', 'theme.php',
        'fetch.php', 'perl.alfa', 'home.php',
        'tes.txt', 'kw.txt', '86890.txt',
    ];

    // Proyectos Laravel en szystems/ — sus public/ tienen PHP legítimo
    // Solo se alertará en dirs de uploads o por nombres maliciosos
    protected $laravelProjects = [
        'buro-v2', 'comfortdreamsnuevo', 'flebonuevo',
        'flebonuevo3', 'flebonuevo4', 'jireautomotrizv2',
    ];

    // Subdirectorios de uploads en proyectos Laravel (NO deben tener PHP)
    protected $uploadDirs = [
        'news', 'imagenes', 'uploads', 'media', 'img', 'images',
    ];

    // Proyectos estáticos en szystems/ — NO deben tener PHP nuevo
    protected $staticProjects = [
        'legally', 'gremia', 'clinicas', 'reproxela', 'soliveri',
        'parajesdemaza', 'proteco', 'goldenseedsgt', 'soportederiesgo',
        'centro', 'fumoccsa',
    ];

    public function handle()
    {
        $publicPath = public_path();
        $suspicious = [];
        $now = time();
        $newFileThreshold = 86400 * 7; // alertar si tiene menos de 7 días

        // Escanear recursivamente public/ buscando .php
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($publicPath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && strtolower($file->getExtension()) === 'php') {
                $relativePath = str_replace($publicPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $relativePath = str_replace('\\', '/', $relativePath);

                // Si está en la lista blanca exacta, saltar siempre
                if (in_array($relativePath, $this->allowedFiles)) {
                    continue;
                }

                $mtime = $file->getMTime();
                $size  = $file->getSize();
                $age   = $now - $mtime;

                // Si está en directorio de confianza Y es antiguo (> 7 días), saltar
                $inTrustedDir = false;
                foreach ($this->trustedDirs as $dir) {
                    if (strpos($relativePath, $dir . '/') === 0) {
                        $inTrustedDir = true;
                        break;
                    }
                }
                if ($inTrustedDir && $age >= $newFileThreshold) {
                    continue;
                }

                $suspicious[] = [
                    'path'     => $relativePath,
                    'size'     => $size,
                    'modified' => date('Y-m-d H:i:s', $mtime),
                    'new'      => ($age < $newFileThreshold),
                ];
            }
        }

        if (empty($suspicious)) {
            $this->info('Integridad OK — sin archivos PHP sospechosos en public/');
            return 0;
        }

        // Agregar hallazgos de szystems/
        $suspicious = array_merge($suspicious, $this->scanSzystems());

        if (empty($suspicious)) {
            $this->info('Integridad OK — asonataxela/public/ y szystems/ limpios');
            return 0;
        }

        $lines = [];
        foreach ($suspicious as $item) {
            $reason = isset($item['reason']) ? " [{$item['reason']}]" : '';
            $tag    = $item['new'] ? '*** NUEVO ***' : '(existente)';
            $lines[] = sprintf(
                "%s%s\n   Ruta: %s\n   Tamaño: %s bytes | Modificado: %s",
                $tag,
                $reason,
                $item['path'],
                number_format($item['size']),
                $item['modified']
            );
        }

        $body = implode("\n\n", $lines);
        $newCount = count(array_filter($suspicious, fn($i) => $i['new']));

        $subject = $newCount > 0
            ? "🚨 ALERTA SEGURIDAD asonataxela.com — {$newCount} archivo(s) PHP NUEVO(S) detectado(s)"
            : "⚠️ Aviso seguridad asonataxela.com — archivos PHP fuera de lista blanca";

        $to = 'oszarata@szystems.com';

        Mail::raw(
            "Scan de integridad PHP — " . now()->format('Y-m-d H:i:s') . "\n" .
            "Servidor: " . gethostname() . "\n\n" .
            "Se encontraron " . count($suspicious) . " archivo(s) PHP no autorizados en public/:\n\n" .
            $body . "\n\n" .
            "Acción recomendada:\n" .
            "1. Verificar vía FTP si son legítimos\n" .
            "2. Si son shells, sobrescribir con: <?php http_response_code(410); die();\n" .
            "3. Contactar iPage soporte si el sitio fue comprometido\n",
            fn($message) => $message->to($to)->subject($subject)
        );

        $this->warn("ALERTA: {$newCount} PHP nuevo(s), " . count($suspicious) . " total. Email enviado a {$to}.");
        foreach ($suspicious as $item) {
            $tag = $item['new'] ? '[NUEVO]' : '[existente]';
            $this->line("{$tag} {$item['path']} ({$item['modified']})");
        }

        return $newCount > 0 ? 1 : 0;
    }

    protected function scanSzystems(): array
    {
        $found = [];
        $szystemsPath = dirname(base_path()) . '/szystems';

        if (!is_dir($szystemsPath)) {
            return $found;
        }

        $now = time();
        $newThreshold = 86400 * 7;

        // 1. Escanear proyectos ESTÁTICOS — alertar si hay PHP nuevo (< 7 días)
        foreach ($this->staticProjects as $project) {
            $dir = $szystemsPath . '/' . $project;
            if (!is_dir($dir)) {
                continue;
            }
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS)
            );
            foreach ($iterator as $file) {
                if (!$file->isFile()) {
                    continue;
                }
                $ext  = strtolower($file->getExtension());
                $name = $file->getFilename();
                $age  = $now - $file->getMTime();

                $isKnownBad  = in_array($name, $this->knownMalicious);
                $isNewPhp    = ($ext === 'php' && $age < $newThreshold);

                if ($isKnownBad || $isNewPhp) {
                    $rel = str_replace($szystemsPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                    $rel = str_replace('\\', '/', $rel);
                    $found[] = [
                        'path'     => 'szystems/' . $rel,
                        'size'     => $file->getSize(),
                        'modified' => date('Y-m-d H:i:s', $file->getMTime()),
                        'new'      => $isKnownBad || ($age < 86400),
                        'reason'   => $isKnownBad ? 'nombre malicioso conocido' : 'PHP nuevo en proyecto estático',
                    ];
                }
            }
        }

        // 2. Escanear proyectos LARAVEL — alertar en dirs de uploads + nombres maliciosos
        foreach ($this->laravelProjects as $project) {
            $publicDir = $szystemsPath . '/' . $project . '/public';
            if (!is_dir($publicDir)) {
                continue;
            }
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($publicDir, \RecursiveDirectoryIterator::SKIP_DOTS)
            );
            foreach ($iterator as $file) {
                if (!$file->isFile()) {
                    continue;
                }
                $ext  = strtolower($file->getExtension());
                $name = $file->getFilename();
                $rel  = str_replace($publicDir . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $rel  = str_replace('\\', '/', $rel);

                $isKnownBad = in_array($name, $this->knownMalicious);

                // Detectar si está en un directorio de uploads
                $inUploadDir = false;
                $parts = explode('/', $rel);
                if (count($parts) > 1 && in_array($parts[0], $this->uploadDirs)) {
                    $inUploadDir = true;
                }

                if ($isKnownBad || ($inUploadDir && $ext === 'php')) {
                    $age = $now - $file->getMTime();
                    $found[] = [
                        'path'     => 'szystems/' . $project . '/public/' . $rel,
                        'size'     => $file->getSize(),
                        'modified' => date('Y-m-d H:i:s', $file->getMTime()),
                        'new'      => $isKnownBad || ($age < $newThreshold),
                        'reason'   => $isKnownBad ? 'nombre malicioso conocido' : 'PHP en directorio de uploads',
                    ];
                }
            }
        }

        return $found;
    }
}
