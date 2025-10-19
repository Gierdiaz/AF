<?php

namespace App\Jobs;

use App\Models\RegistroFundoCvm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImportarFundosJob implements ShouldQueue
{
    use Queueable;

    protected string $csvFile;

    public function __construct(string $csvFile)
    {
        $this->csvFile = $csvFile;
    }

    public function handle(): void
    {
        if (!file_exists($this->csvFile)) {
            Log::error('CSV não encontrado: ' . $this->csvFile);
            return;
        }

        $total = 0;
        $handle = $this->abrirCsv();

        if (!$handle) return;

        $cabecalho = $this->lerCabecalho($handle);

        while (($linha = fgetcsv($handle, 0, ";")) !== false) {
            $registro = $this->processarLinha($cabecalho, $linha);

            if (!$registro) continue; // Ignora linhas sem CPF/CNPJ do gestor

            $this->atualizarRegistro($registro);
            $total++;
        }

        fclose($handle);

        $this->limparDiretorio();

        Log::info("Importação finalizada com sucesso. Total de registros importados/atualizados: {$total}");
    }

    private function abrirCsv()
    {
        return fopen($this->csvFile, 'r');
    }

    private function lerCabecalho($handle): array
    {
        $cabecalho = fgetcsv($handle, 0, ";");

        // Converte para UTF-8
        return array_map(fn($c) => mb_convert_encoding(trim($c), 'UTF-8', 'ISO-8859-1'), $cabecalho);
    }

    private function processarLinha(array $cabecalho, array $linha): ?array
    {
        // Converte cada campo para UTF-8
        $linha = array_map(function ($valor) {
            if (is_string($valor)) {
                return mb_convert_encoding(trim($valor), 'UTF-8', 'ISO-8859-1');
            }
            return $valor;
        }, $linha);

        // Preenche com null se faltar coluna
        $linha += array_fill(0, count($cabecalho), null);

        $registro = array_combine($cabecalho, $linha);

        if (blank(Arr::get($registro, 'CPF_CNPJ_Gestor'))) {
            return null;
        }

        // Trata datas vazias
        foreach (['Data_Registro', 'Data_Constituicao', 'Data_Cancelamento'] as $campo) {
            if (empty($registro[$campo])) {
                $registro[$campo] = null;
            }
        }

        return $registro;
    }

    private function atualizarRegistro(array $registro): void
    {
        RegistroFundoCvm::updateOrCreate(
            ['codigo_cvm' => Arr::get($registro, 'Codigo_CVM')],
            [
                'denominacao_social' => Arr::get($registro, 'Denominacao_Social'),
                'cnpj_fundo' => Arr::get($registro, 'CNPJ_Fundo'),
                'tipo_fundo' => Arr::get($registro, 'Tipo_Fundo'),
                'cnpj_administrador' => Arr::get($registro, 'CNPJ_Administrador'),
                'administrador' => Arr::get($registro, 'Administrador'),
                'cpf_cnpj_gestor' => Arr::get($registro, 'CPF_CNPJ_Gestor'),
                'gestor' => Arr::get($registro, 'Gestor'),
                'situacao' => Arr::get($registro, 'Situacao'),
                'data_registro' => Arr::get($registro, 'Data_Registro'),
                'data_constituicao' => Arr::get($registro, 'Data_Constituicao'),
                'data_cancelamento' => Arr::get($registro, 'Data_Cancelamento'),
            ]
        );
    }

    private function limparDiretorio(): void
    {
        $extractPath = dirname($this->csvFile);

        if (is_dir($extractPath)) {
            File::deleteDirectory($extractPath);
        }
    }
}
