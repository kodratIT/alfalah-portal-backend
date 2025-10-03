<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use App\Filament\Resources\BeritaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditBerita extends EditRecord
{
    protected static string $resource = BeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->after(function () {
                    // Delete old thumbnail when deleting record
                    if ($this->record->thumbnail && Storage::disk('public')->exists($this->record->thumbnail)) {
                        Storage::disk('public')->delete($this->record->thumbnail);
                    }
                }),
        ];
    }
}
