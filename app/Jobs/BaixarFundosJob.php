<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class BaixarFundosJob implements ShouldQueue
{
    use Queueable;

    protected string $url;
    protected string $zipPath;
    protected string $extractPath;

    public function __construct()
    {
        $this->url = "https://dados.cvm.gov.br/dados/FI/CAD/DADOS/registro_fundo_classe.zip";
        $this->zipPath = storage_path('app/registro_fundo_classe.zip');
        $this->extractPath = storage_path('app/registro_fundo_classe');
    }

    public function handle(): void
    {
        if (!$this->baixarArquivo()) {
            return;
        }

        if (!$this->extrairArquivo()) {
            return;
        }

        $this->dispararImportacao();
        $this->limparZip();
    }

    private function baixarArquivo(): bool
    {
        $response = Http::withoutVerifying()->get($this->url);

        if (!$response->successful()) {
            Log::error('Falha ao baixar o arquivo de fundos: ' . $response->status());
            return false;
        }

        file_put_contents($this->zipPath, $response->body());
        return true;
    }

    private function extrairArquivo(): bool
    {
        $zip = new ZipArchive();
        if ($zip->open($this->zipPath) !== true) {
            Log::error('Não foi possível extrair o arquivo ZIP.');
            return false;
        }

        $zip->extractTo($this->extractPath);
        $zip->close();

        return true;
    }

    private function dispararImportacao(): void
    {
        $csvFile = $this->extractPath . '/registro_fundo.csv';
        Log::info('CSV path: ' . $csvFile);

        if (!file_exists($csvFile)) {
            Log::error("Arquivo CSV não encontrado: {$csvFile}");
            return;
        }

        ImportarFundosJob::dispatch($csvFile);
    }

    private function limparZip(): void
    {
        if (file_exists($this->zipPath)) {
            unlink($this->zipPath);
        }
    }
}
