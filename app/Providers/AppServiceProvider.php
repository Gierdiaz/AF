<?php

namespace App\Providers;

use App\Interfaces\FundoRepositoryInterface;
use App\Interfaces\InvestimentoRepositoryInterface;
use App\Interfaces\ParticipanteRepositoryInterface;
use App\Repositories\FundoRepository;
use App\Repositories\InvestimentoRepository;
use App\Repositories\ParticipanteRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FundoRepositoryInterface::class, FundoRepository::class);
        $this->app->bind(ParticipanteRepositoryInterface::class, ParticipanteRepository::class);
        $this->app->bind(InvestimentoRepositoryInterface::class, InvestimentoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
