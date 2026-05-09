<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransportCompany;
use App\Models\Voyage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoyageImportController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt,xlsx,xls'],
        ]);

        $file = $request->file('file');
        $ext = strtolower((string) $file->getClientOriginalExtension());

        if (in_array($ext, ['xlsx', 'xls'], true) && ! extension_loaded('zip')) {
            return back()->with('error', "L'import Excel requiert l'extension PHP zip (XAMPP). Active-la puis redémarre Apache/PHP.");
        }

        if (! in_array($ext, ['csv', 'txt'], true)) {
            return back()->with('error', "Import direct XLSX indisponible dans cet environnement. Exporte d'abord en CSV puis importe.");
        }

        $handle = fopen($file->getRealPath(), 'r');
        if (! $handle) {
            return back()->with('error', "Impossible de lire le fichier.");
        }

        $firstLine = fgets($handle);
        $header = $firstLine ? str_getcsv($firstLine, ';') : [];
        if (count($header) <= 1) {
            $header = $firstLine ? str_getcsv($firstLine, ',') : [];
        }
        if (! $header) {
            fclose($handle);
            return back()->with('error', "Fichier vide.");
        }

        $header = array_map(fn ($h) => strtolower(trim((string) $h)), $header);
        $count = 0;

        while (($line = fgets($handle)) !== false) {
            $row = str_getcsv($line, ';');
            if (count($row) <= 1) {
                $row = str_getcsv($line, ',');
            }
            if (count($row) < 3) {
                continue;
            }

            $data = array_combine($header, $row);
            if (! $data) {
                continue;
            }

            $companyName = trim((string) ($data['societe de transport'] ?? $data['societe'] ?? 'Societe inconnue'));
            $company = TransportCompany::firstOrCreate(['name' => $companyName], ['is_active' => true]);

            Voyage::create([
                'transport_company_id' => $company->id,
                'line_name' => trim((string) ($data['ligne'] ?? $data['line'] ?? '')),
                'destination' => trim((string) ($data['destination'] ?? '')),
                'travel_date' => $this->normalizeDate($data['date'] ?? null),
                'departure_time' => $this->normalizeTime($data['heure depart'] ?? $data['heure_depart'] ?? null),
                'tickets' => (int) ($data['nbticket'] ?? $data['tickets'] ?? 0),
                'total_ttc' => (float) str_replace(',', '.', (string) ($data['totalttc'] ?? $data['montant'] ?? 0)),
                'observations' => trim((string) ($data['observation'] ?? $data['observations'] ?? '')),
                'is_blocked' => (int) ($data['bloquer'] ?? 0) === 1,
                'blocked_by' => trim((string) ($data['bloque par'] ?? $data['bloque_par'] ?? '')),
                'created_by_name' => trim((string) ($data['creer par'] ?? $data['creer_par'] ?? '')),
                'ville_depart' => 'Taza',
                'ville_arrivee' => trim((string) ($data['destination'] ?? '')),
                'date_voyage' => $this->normalizeDate($data['date'] ?? null),
                'prix' => (float) str_replace(',', '.', (string) ($data['totalttc'] ?? $data['montant'] ?? 0)),
                'places_disponibles' => (int) ($data['nbticket'] ?? $data['tickets'] ?? 0),
            ]);
            $count++;
        }

        fclose($handle);

        return back()->with('success', "{$count} voyages importes depuis le fichier.");
    }

    private function normalizeDate(mixed $value): ?string
    {
        if (! $value) {
            return null;
        }
        $value = trim((string) $value);
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            return $value;
        }
        $parts = preg_split('/[\/\-]/', $value);
        if (count($parts) === 3) {
            [$d, $m, $y] = $parts;
            return sprintf('%04d-%02d-%02d', (int) $y, (int) $m, (int) $d);
        }
        return null;
    }

    private function normalizeTime(mixed $value): ?string
    {
        if (! $value) {
            return null;
        }
        $value = trim((string) $value);
        if (preg_match('/^\d{2}:\d{2}/', $value)) {
            return substr($value, 0, 5);
        }
        return null;
    }
}
