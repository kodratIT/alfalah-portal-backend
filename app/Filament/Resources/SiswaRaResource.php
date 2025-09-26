<?php
namespace App\Filament\Resources;

use App\Filament\Resources\SiswaRaResource\Pages;
use App\Models\SiswaRa;
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

class SiswaRaResource extends Resource
{
    protected static ?string $model = SiswaRa::class;

    protected static ?string $navigationLabel = 'Siswa RA';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Pribadi')
                ->schema([
                    TextInput::make('nama')->required(),
                    TextInput::make('nik')->required()->unique(ignoreRecord: true),
                    Select::make('jenis_kelamin')
                        ->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])
                        ->required(),
                    DatePicker::make('tanggal_lahir')->required(),
                    TextInput::make('tempat_lahir')->required(),
                    TextInput::make('agama'),
                    TextInput::make('anak_ke'),
                    TextInput::make('jumlah_saudara'),
                    FileUpload::make('foto')->image()->directory('siswa-ra-foto'),
                ])->columns(2),

            Section::make('Alamat')
                ->schema([
                    Textarea::make('alamat')->rows(3)->required(),
                ]),

            Section::make('Data Orang Tua')
                ->schema([
                    TextInput::make('nama_ayah')->required(),
                    TextInput::make('pekerjaan_ayah'),
                    TextInput::make('pendidikan_ayah'),
                    TextInput::make('nama_ibu')->required(),
                    TextInput::make('pekerjaan_ibu'),
                    TextInput::make('pendidikan_ibu'),
                    TextInput::make('no_hp_wali')->label('No. HP Wali')->required(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('foto')->rounded()->label('Foto'),
            TextColumn::make('nama')->searchable(),
            TextColumn::make('nik'),
            BadgeColumn::make('jenis_kelamin'),
            TextColumn::make('nama_ayah'),
            TextColumn::make('nama_ibu'),
        ])->defaultSort('nama')
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
            'index' => Pages\ListSiswaRas::route('/'),
            'create' => Pages\CreateSiswaRa::route('/create'),
            'edit' => Pages\EditSiswaRa::route('/{record}/edit'),
        ];
    }
}
