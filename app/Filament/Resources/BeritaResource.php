<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Berita')
                ->schema([
                    TextInput::make('judul')
                        ->label('Judul Berita')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->dehydrated(),

                    Select::make('kategori')
                        ->label('Kategori')
                        ->options([
                            'Akademik' => 'Akademik',
                            'Kegiatan' => 'Kegiatan',
                            'Prestasi' => 'Prestasi',
                        ])
                        ->required()
                        ->native(false),

                    DatePicker::make('tanggal')
                        ->label('Tanggal')
                        ->required(),

                    TextInput::make('penulis')
                        ->label('Penulis')
                        ->required(),

                    FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('berita')
                        ->imageEditor()
                        ->required(),
                ])->columns(2),

            Section::make('Konten Berita')
                ->schema([
                    RichEditor::make('konten')
                        ->label('Isi Berita')
                        ->required()
                        ->fileAttachmentsDirectory('berita/files'),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('thumbnail')
                ->label('Thumbnail')
                ->square()
                ->height(60),

            TextColumn::make('judul')
                ->label('Judul')
                ->searchable()
                ->limit(40),

            TextColumn::make('slug')
                ->label('Slug')
                ->searchable()
                ->limit(50),

            BadgeColumn::make('kategori')
                ->label('Kategori')
                ->colors([
                    'success' => 'Prestasi',
                    'warning' => 'Kegiatan',
                    'info' => 'Akademik',
                ]),

            TextColumn::make('penulis')->label('Penulis'),

            TextColumn::make('tanggal')
                ->label('Tanggal')
                ->date(),

            TextColumn::make('created_at')
                ->label('Dibuat')
                ->since(),
        ])
        ->defaultSort('tanggal', 'desc')
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
