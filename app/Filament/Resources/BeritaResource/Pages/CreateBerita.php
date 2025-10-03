<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use App\Filament\Resources\BeritaResource;
use App\Services\ImageCompressionService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateBerita extends CreateRecord
{
    protected static string $resource = BeritaResource::class;

    protected function afterCreate(): void
    {
        // Compress thumbnail after it's been saved
        if ($this->record->thumbnail) {
            $compressed = ImageCompressionService::compress($this->record->thumbnail, 'public', 500);
            
            if ($compressed) {
                Notification::make()
                    ->title('Berita berhasil disimpan')
                    ->success()
                    ->send();
            }
        }
    }
}
