<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationLabel = 'Profil Pesantren';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Umum')
                ->description('Isi informasi utama tentang pesantren')
                ->schema([
                    TextInput::make('judul')
                        ->label('Judul Profil')
                        ->required()
                        ->maxLength(255),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi Singkat')
                        ->rows(3)
                        ->placeholder('Tuliskan deskripsi umum pesantren...'),

                    Textarea::make('sejarah')
                        ->label('Sejarah')
                        ->rows(6)
                        ->placeholder('Tuliskan sejarah berdirinya pesantren...')
                        ->required(),

                    FileUpload::make('gambar_sejarah')
                        ->label('Gambar Sejarah')
                        ->image()
                        ->directory('sejarah')
                        ->required(),

                    TextInput::make('tahun_berdiri')
                        ->label('Tahun Berdiri')
                        ->numeric()
                        ->required(),
                ])->columns(2),

            Section::make('Visi dan Misi')
                ->description('Tujuan dan misi pesantren')
                ->schema([
                    Textarea::make('visi')
                        ->label('Visi')
                        ->rows(2)
                        ->placeholder('Tuliskan visi pesantren...')
                        ->required(),

                    Repeater::make('misi')
                        ->label('Misi')
                        ->schema([
                            Textarea::make('misi_item')
                                ->label('Poin Misi')
                                ->placeholder('Contoh: Mendidik santri menjadi pribadi islami...')
                        ])
                        ->addActionLabel('Tambah Misi')
                        ->columns(1)
                        ->collapsible()
                        ->reorderable()
                        ->grid(1),
                ]),

            Section::make('Fasilitas Pesantren')
                ->schema([
                    Repeater::make('fasilitas')
                    ->label('Fasilitas')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Fasilitas')
                            ->placeholder('Contoh: Perpustakaan, Asrama, Lapangan')
                    ])
                    ->addActionLabel('Tambah Fasilitas')
                    ->columns(1)
                    ->collapsible()
                    ->reorderable(),
                ]),

            Section::make('Pimpinan Pesantren')
                ->description('Data struktural dan pimpinan utama pesantren')
                ->schema([
                    Repeater::make('pimpinan')
                        ->schema([
                            TextInput::make('nama')
                                ->label('Nama Pimpinan'),

                            TextInput::make('jabatan')
                                ->label('Jabatan'),

                            FileUpload::make('foto')
                                ->label('Foto Pimpinan')
                                ->image()
                                ->directory('pimpinan'),

                            Textarea::make('deskripsi')
                                ->label('Deskripsi Singkat')
                                ->rows(3),
                        ])
                        ->addActionLabel('Tambah Pimpinan')
                        ->columns(2)
                        ->collapsible()
                        ->reorderable(),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar_sejarah')
                    ->label('Gambar')
                    ->rounded()
                    ->square()
                    ->height(50),

                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('tahun_berdiri')
                    ->label('Berdiri')
                    ->badge()
                    ->color('success'),

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
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
