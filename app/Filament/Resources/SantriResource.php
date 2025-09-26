<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SantriResource\Pages;
use App\Models\Santri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;

class SantriResource extends Resource
{
    protected static ?string $model = Santri::class;

    protected static ?string $navigationLabel = 'Santri';
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Santri')
                ->schema([
                    TextInput::make('nama')->required(),
                    TextInput::make('nik')->required()->unique(ignoreRecord: true),
                    Select::make('jenis_kelamin')
                        ->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])
                        ->required(),
                    TextInput::make('tempat_lahir')->required(),
                    DatePicker::make('tanggal_lahir')->required(),
                    FileUpload::make('foto')->image()->directory('santri-foto'),
                ])->columns(2),

            Section::make('Data Wali')
                ->schema([
                    TextInput::make('nama_wali')->required()->label('Nama Wali'),
                    TextInput::make('no_hp_wali')->required()->label('No. HP Wali'),
                    Textarea::make('alamat')->required()->rows(3),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('foto')->rounded()->label('Foto'),
            TextColumn::make('nama')->searchable()->sortable(),
            TextColumn::make('nik')->label('NIK'),
            BadgeColumn::make('jenis_kelamin'),
            TextColumn::make('nama_wali'),
        ])->defaultSort('nama', 'asc')
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
            'index' => Pages\ListSantris::route('/'),
            'create' => Pages\CreateSantri::route('/create'),
            'edit' => Pages\EditSantri::route('/{record}/edit'),
        ];
    }
}