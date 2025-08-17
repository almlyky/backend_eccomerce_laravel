<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pr_name')
                    ->label('Product Name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('pr_name_en')
                    ->label('Product Name (English)')
                    ->required()
                    ->maxLength(50),
                Forms\Components\FileUpload::make('pr_image')
                    ->label('Product Image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('pr_cost')
                    ->label('Product Cost')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('pr_cost_new')
                    ->label('New Product Cost')
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('pr_detail')
                    ->label('Product Details')
                    ->required()
                    ->maxLength(150),
                Forms\Components\Textarea::make('pr_detail_en')
                    ->label('Product Details (English)')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('pr_discoutn')
                    ->label('Discount')
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('cat_fk')
                    ->label('Category')
                    ->relationship('myCategory', 'cat_name') // Assuming `cat_name` is the column for category name.
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pr_id')
                ->label('Product id'),
                Tables\Columns\TextColumn::make('pr_name')
                    ->label('Product Name'),
                Tables\Columns\TextColumn::make('pr_name_en')
                    ->label('Product Name (English)'),
                Tables\Columns\ImageColumn::make('pr_image'),
                Tables\Columns\TextColumn::make('pr_cost')
                    ->label('Product Cost'),
                Tables\Columns\TextColumn::make('pr_cost_new')
                    ->label('New Product Cost'),
                Tables\Columns\TextColumn::make('pr_discoutn')
                    ->label('Discount'),
                Tables\Columns\TextColumn::make('category.cat_name')
                    ->label('Category'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
