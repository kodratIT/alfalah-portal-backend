<?php
namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use App\Models\Laporan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Support\Facades\Storage;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;

    protected static ?string $navigationLabel = 'Laporan';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Laporan & Arsip';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Laporan')
                ->schema([
                    TextInput::make('judul')->required(),
                    DatePicker::make('tanggal')->required(),
                    Select::make('kategori')
                        ->required()
                        ->options([
                            'Kegiatan' => 'Kegiatan',
                            'Keuangan' => 'Keuangan',
                            'Donasi' => 'Donasi',
                            'Lainnya' => 'Lainnya',
                        ]),
                    Textarea::make('deskripsi')->rows(3),
                    FileUpload::make('file_lampiran')
                        ->label('Lampiran (Opsional)')
                        ->directory('lampiran-laporan')
                        ->downloadable()
                        ->openable()
                        ->previewable()
                        ->acceptedFileTypes(['application/pdf', 'image/*']),
                ])->columns(2),
        ]);
    }

        public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('M d, Y')
                    ->sortable(),

                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable(),

                BadgeColumn::make('kategori')
                    ->label('Kategori')
                    ->colors([
                        'warning' => 'Keuangan',
                        'success' => 'Kegiatan',
                        'info' => 'Akademik',
                        'danger' => 'Donasi',
                        'gray' => 'Lainnya',
                    ]),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([])
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
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }
}
