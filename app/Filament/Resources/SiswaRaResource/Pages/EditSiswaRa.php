<?php

namespace App\Filament\Resources\SiswaRaResource\Pages;

use App\Filament\Resources\SiswaRaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiswaRa extends EditRecord
{
    protected static string $resource = SiswaRaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
