<?php

namespace App\Filament\Resources;

use App\Models\ContactInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\ContactInfoResource\Pages;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;

    protected static ?string $navigationLabel = 'Informasi Kontak';
    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationGroup = 'Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Alamat Pesantren')
                ->schema([
                    Textarea::make('alamat')
                        ->label('Alamat Lengkap')
                        ->rows(3)
                        ->required(),
                ]),

            Section::make('Kontak')
                ->schema([
                    TextInput::make('telepon_kantor')->label('Telepon Kantor'),
                    TextInput::make('telepon_hp')->label('Nomor HP'),
                    TextInput::make('telepon_wa')->label('Nomor WhatsApp'),
                ])->columns(3),

            Section::make('Email')
                ->schema([
                    Repeater::make('emails')
                        ->label('Daftar Email')
                        ->schema([
                            TextInput::make('value')
                                ->label('Alamat Email')
                                ->email()
                                ->required(),
                        ])
                        ->addActionLabel('Tambah Email')
                        ->collapsible()
                        ->defaultItems(1)
                        ->columns(1),
                ]),

            Section::make('Jam Layanan')
                ->schema([
                    TextInput::make('jam_kerja_senin_jumat')->label('Senin - Jumat'),
                    TextInput::make('jam_kerja_sabtu')->label('Sabtu'),
                    TextInput::make('jam_kerja_minggu')->label('Minggu'),
                ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('alamat')
                ->label('Alamat')
                ->limit(20),

            TextColumn::make('telepon_kantor')->label('Telp Kantor'),
            TextColumn::make('telepon_hp')->label('HP'),
            TextColumn::make('telepon_wa')->label('WhatsApp'),
            TextColumn::make('created_at')->label('Dibuat')->since(),
        ])->defaultSort('id', 'desc')
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
            'index' => Pages\ListContactInfos::route('/'),
            'create' => Pages\CreateContactInfo::route('/create'),
            'edit' => Pages\EditContactInfo::route('/{record}/edit'),
        ];
    }
}
