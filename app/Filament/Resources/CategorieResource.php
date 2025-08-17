<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategorieResource\Pages;
use App\Filament\Resources\CategorieResource\RelationManagers;
use App\Models\Categorie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Log;

class CategorieResource extends Resource
{
    protected static ?string $model = Categorie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                TextInput::make('cat_name')
                    ->label('اسم التصنيف')
                    ->maxLength(50)
                    ->required(),
                TextInput::make('cat_name_en')
                    ->label('اسم التصنيف بالإنجليزية')
                    ->maxLength(50)
                    ->required(),
                FileUpload::make('cat_image')
                    ->label('Category Image')          // نص التسمية
                    ->image()                          // لرفع صورة فقط
                    ->required()


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([


                ImageColumn::make('cat_image')
                    ->height(50)
                    ->width(50)
                    ->circular(),
                TextColumn::make('cat_name')
                    ->label('اسم التصنيف')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('cat_name_en')
                    ->label('اسم التصنيف بالإنجليزية')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategorie::route('/create'),
            'edit' => Pages\EditCategorie::route('/{record}/edit'),
        ];
    }
}
