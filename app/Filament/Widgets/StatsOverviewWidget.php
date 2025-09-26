<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use App\Models\Donasi;
use App\Models\Guru;
use App\Models\Program;
use App\Models\Santri;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
         return [
            Stat::make('Total Santri', Santri::count())
                ->description('Jumlah santri aktif')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Total Guru', Guru::count())
                ->description('Tenaga pengajar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
                
            Stat::make('Total Donasi', 'Rp ' . number_format(Donasi::sum('jumlah'), 0, ',', '.'))
                ->description('Total donasi masuk')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
                
            Stat::make('Jumlah Berita', Berita::count())
                ->description('Artikel terpublikasi')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
                
            Stat::make('Program Aktif', Program::count())
                ->description('Program berjalan')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),
        ];
    }
}
