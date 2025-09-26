<?php

namespace App\Filament\Pages;

use App\Models\Santri;
use App\Models\Guru;
use App\Models\Donasi;
use App\Models\Berita;
use App\Models\Program;
use App\Models\SiswaRa;
use Filament\Pages\Page;

class DashboardOverview extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard-overview';
    protected static ?string $title = 'Dashboard';
    protected static ?int $navigationSort = -1;

    protected function getViewData(): array
    {
        return [
            'totalSantri' => Santri::count(),
            'totalGuru' => Guru::count(),
            'totalDonasi' => Donasi::sum('jumlah'),
            'totalBerita' => Berita::count(),
            'totalProgram' => Program::count(),
            'totalSiswaRa' => SiswaRa::count(),
        ];
    }
}
