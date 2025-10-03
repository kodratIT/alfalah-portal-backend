<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use App\Filament\Resources\BeritaResource;
use App\Services\ImageCompressionService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
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

    protected function afterSave(): void
    {
        // Compress thumbnail if it was updated
        if ($this->record->thumbnail) {
            $compressed = ImageCompressionService::compress($this->record->thumbnail, 'public', 500);
            
            if ($compressed) {
                Notification::make()
                    ->title('Perubahan berhasil disimpan')
                    ->success()
                    ->send();
            }
        }
    }
}
