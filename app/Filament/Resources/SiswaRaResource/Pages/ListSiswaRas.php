<?php

namespace App\Filament\Resources\SiswaRaResource\Pages;

use App\Filament\Resources\SiswaRaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiswaRas extends ListRecords
{
    protected static string $resource = SiswaRaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
