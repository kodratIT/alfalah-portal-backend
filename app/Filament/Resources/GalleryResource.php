<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Radio;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationLabel = 'Galeri';
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Umum')
                ->description('Isi judul, deskripsi, dan jenis media')
                ->schema([
                    TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label('Deskripsi Singkat')
                        ->placeholder('Tuliskan deskripsi kegiatan atau fasilitas...')
                        ->rows(3),

                    Select::make('category')
                        ->label('Kategori')
                        ->required()
                        ->options([
                            'Fasilitas' => 'Fasilitas',
                            'Kegiatan' => 'Kegiatan',
                            'Pembelajaran' => 'Pembelajaran',
                            'Prestasi' => 'Prestasi',
                        ])
                        ->searchable(),

                    Radio::make('type')
                        ->label('Tipe Media')
                        ->options([
                            'Foto' => 'Foto',
                            'Video' => 'Video',
                        ])
                        ->inline()
                        ->default('Foto')
                        ->reactive(),
                    
                    TextInput::make('video_url')
                        ->label('URL Video (Opsional)')
                        ->placeholder('https://youtube.com/...')
                        ->visible(fn ($get) => $get('type') === 'Video'),

                    Toggle::make('is_featured')
                        ->label('Tandai sebagai Populer')
                        ->inline(false),
                ])->columns(2),

            Section::make('Thumbnail')
                ->description('Upload thumbnail utama galeri')
                ->schema([
                    FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('galleries')
                        ->required()
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->square()
                    ->height(50),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge(),

                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn ($state) => $state === 'Video' ? 'danger' : 'success'),

                IconColumn::make('is_featured')
                    ->label('Populer')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
