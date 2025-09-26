<?php
namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Models\Guru;
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

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationLabel = 'Guru';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Pribadi')
                ->description('Informasi dasar guru')
                ->schema([
                    TextInput::make('nama')->required()->maxLength(255),
                    TextInput::make('nip')->maxLength(100),
                    Select::make('jenis_kelamin')
                        ->options([
                            'Laki-laki' => 'Laki-laki',
                            'Perempuan' => 'Perempuan',
                        ])
                        ->required(),
                    TextInput::make('tempat_lahir')->required(),
                    DatePicker::make('tanggal_lahir')->required(),
                    FileUpload::make('foto')
                        ->label('Foto')
                        ->image()
                        ->directory('guru-foto')
                        ->maxSize(2048),
                ])->columns(2),

            Section::make('Kontak & Pendidikan')
                ->schema([
                    TextInput::make('no_hp')->label('No. HP')->required(),
                    TextInput::make('email')->email(),
                    Select::make('pendidikan_terakhir')
                        ->options([
                            'SD' => 'SD',
                            'SMP' => 'SMP',
                            'SMA' => 'SMA',
                            'D3' => 'D3',
                            'S1' => 'S1',
                            'S2' => 'S2',
                            'S3' => 'S3',
                        ])
                        ->required(),
                    Textarea::make('alamat')->rows(3)->required(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('foto')->rounded()->label('Foto'),
            TextColumn::make('nama')->searchable()->sortable(),
            TextColumn::make('nip')->label('NIP'),
            BadgeColumn::make('jenis_kelamin'),
            TextColumn::make('pendidikan_terakhir')->label('Pendidikan'),
            TextColumn::make('no_hp')->label('Kontak'),
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}