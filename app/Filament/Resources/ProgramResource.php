<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
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

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationLabel = 'Program';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Program')
                ->schema([
                    TextInput::make('judul')
                        ->label('Judul Program')
                        ->required(),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi Program')
                        ->rows(3),

                    TextInput::make('kategori_usia')
                        ->label('Masa Belajar'),

                    TextInput::make('jumlah_santri')
                        ->label('Jumlah Santri'),

                    TextInput::make('kategori')
                        ->label('Kategori Program'),

                    FileUpload::make('gambar')
                        ->label('Gambar Program')
                        ->image()
                        ->directory('program')
                        ->required(),
                ])->columns(2),

            Section::make('Keunggulan')
                ->schema([
                    Repeater::make('keunggulan')
                        ->label('Keunggulan Program')
                        ->schema([
                            TextInput::make('value')
                                ->label('Poin Keunggulan'),
                        ])
                        ->addActionLabel('Tambah Keunggulan')
                        ->collapsible()
                        ->columns(1),
                ]),

            Section::make('Jadwal')
                ->schema([
                    Repeater::make('jadwal')
                        ->label('Jadwal Program')
                        ->schema([
                            TextInput::make('value')
                                ->label('Poin Jadwal'),
                        ])
                        ->addActionLabel('Tambah Jadwal')
                        ->collapsible()
                        ->columns(1),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->square()
                    ->height(50),

                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable(),

                TextColumn::make('kategori_usia')->label('Masa Belajar'),
                TextColumn::make('jumlah_santri')->label('Santri'),
                TextColumn::make('kategori')->label('Kategori Program'),
                TextColumn::make('created_at')->label('Dibuat')->since(),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
