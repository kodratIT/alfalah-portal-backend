<?php
namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationLabel = 'Testimoni';
    protected static ?string $navigationGroup = 'Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')->label('Nama')->required(),

            Select::make('peran')
                ->label('Peran')
                ->options([
                    'Alumni' => 'Alumni',
                    'Wali Santri' => 'Wali Santri',
                    'Santri' => 'Santri',
                ])
                ->required(),

            TextInput::make('angkatan')->label('Keterangan (angkatan / profesi)'),

            Textarea::make('testimoni')->label('Isi Testimoni')->rows(4)->required(),

            FileUpload::make('foto')
                ->label('Foto')
                ->image()
                ->directory('testimoni')
                ->imageEditor()
                ->imagePreviewHeight('150'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')->label('Foto')->circular(),
                TextColumn::make('nama')->searchable(),
                TextColumn::make('peran'),
                TextColumn::make('angkatan'),
                TextColumn::make('testimoni')->limit(40),
                TextColumn::make('created_at')->since()->label('Dibuat'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
