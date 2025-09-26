<?php
namespace App\Filament\Resources;

use App\Filament\Resources\DonasiResource\Pages;
use App\Models\Donasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class DonasiResource extends Resource
{
    protected static ?string $model = Donasi::class;

    protected static ?string $navigationLabel = 'Donasi / Infaq';
    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';
    protected static ?string $navigationGroup = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Donasi')
                ->schema([
                    TextInput::make('nama_donatur')->label('Nama Donatur'),
                    TextInput::make('nomor_hp')->label('Nomor HP'),
                    TextInput::make('email')->email(),

                    DatePicker::make('tanggal')->required(),
                    Select::make('jenis_donasi')
                        ->required()
                        ->options([
                            'Infaq' => 'Infaq',
                            'Zakat' => 'Zakat',
                            'Wakaf' => 'Wakaf',
                            'Sedekah' => 'Sedekah',
                            'Donasi Program' => 'Donasi Program',
                        ]),
                    TextInput::make('jumlah')
                        ->required()
                        ->numeric()
                        ->prefix('Rp'),
                    Select::make('metode_pembayaran')
                        ->options([
                            'Tunai' => 'Tunai',
                            'Transfer Bank' => 'Transfer Bank',
                            'QRIS' => 'QRIS',
                        ]),
                    Textarea::make('keterangan')->rows(3),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('tanggal')->date(),
            TextColumn::make('nama_donatur')->label('Donatur')->searchable(),
            BadgeColumn::make('jenis_donasi'),
            TextColumn::make('jumlah')->money('IDR', locale: 'id'),
            TextColumn::make('metode_pembayaran'),
        ])->defaultSort('tanggal', 'desc')
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
            'index' => Pages\ListDonasis::route('/'),
            'create' => Pages\CreateDonasi::route('/create'),
            'edit' => Pages\EditDonasi::route('/{record}/edit'),
        ];
    }
}
