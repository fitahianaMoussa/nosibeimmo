<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImmobilierResource\Pages;
use App\Models\Category;
use App\Models\Image as ImageModel;
use App\Models\Immobilier;
use App\Models\Subcategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ImmobilierResource extends Resource
{
    protected static ?string $model = Immobilier::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function generateReference($categoryId, $subcategoryId) {
        if (!$categoryId || !$subcategoryId) {
            return null;
        }

        $category = Category::find($categoryId);
        $subcategory = Subcategory::find($subcategoryId);
        $categoryInitial = $category->nom == 'Vente' ? 'VT' : 'LC';
        $subcategoryInitial = strtoupper(substr($subcategory->nom, 0, 2));
        $count = Immobilier::where('subcategory_id', $subcategoryId)->count();
        $incrementedCount = str_pad($count + 1, 2, '0', STR_PAD_LEFT);
        return $categoryInitial . $subcategoryInitial . ' ' . $incrementedCount;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('categorie_id')
                    ->relationship('category', 'nom')
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('subcategory_id', null))
                    ->required(),
                Select::make('subcategory_id')
                    ->options(function (callable $get) {
                        $categoryId = $get('categorie_id');
                        if ($categoryId) {
                            $subcategories = Subcategory::where('categorie_id', $categoryId)->pluck('nom', 'id');
                            if ($subcategories->isEmpty()) {
                                info('No subcategories found for category ID: ' . $categoryId);
                            }
                            return $subcategories;
                        }
                        return Subcategory::all()->pluck('nom', 'id');
                    })
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $categoryId = $get('categorie_id');
                        $subcategoryId = $get('subcategory_id');
                        if ($categoryId && $subcategoryId) {
                            $reference = ImmobilierResource::generateReference($categoryId, $subcategoryId);
                            $set('reference', $reference);
                        }
                    }),
                TextInput::make('titre')
                    ->required()
                    ->maxLength(255),
                    TextInput::make('reference')
                    ->required()
                    ->maxLength(255)
                    ->disabled(),
                TextInput::make('prix')
                    ->numeric()
                    ->required(),
                TextInput::make('surface')
                    ->numeric()
                    ->required(),
                RichEditor::make('description')
                    ->label('Description')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ]),
                FileUpload::make('images_couverture')
                    ->label('Images de Couverture')
                    ->directory('uploads/immobiliers')
                    ->preserveFilenames(),
                Toggle::make('electricite')->label('Electricité')->default(false),
                Toggle::make('eau')->label('Eau')->default(false),
                TextInput::make('situation_juridique')->maxLength(255),
                Toggle::make('vue_sur_la_mer')->label('Vue sur la Mer')->default(false),
                Toggle::make('plage')->label('Plage')->default(false),
                FileUpload::make('images')
                    ->label('Images')
                    ->multiple()
                    ->image()
                    ->directory('uploads/immobiliers')
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])
                    ->preserveFilenames()
                    ->saveRelationshipsUsing(function ($component, $state, $record) {
                        // Save images to the database
                        foreach ($state as $imagePath) {
                            ImageModel::create([
                                'immobilier_id' => $record->id,
                                'image_path' => $imagePath,
                            ]);
                        }
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subcategory.nom'),
                TextColumn::make('titre'),
                TextColumn::make('prix')->sortable(),
                TextColumn::make('surface')->sortable(),
                TextColumn::make('reference'),
                TextColumn::make('images')
                ->label('Images')
                ->formatStateUsing(function ($record) {
                    $images = ImageModel::where('immobilier_id', $record->id)->get();
                    return view('immobilier_images', ['images' => $images])->render();
                })
                ->html(), // Render HTML in the column
        ])
                 
            ->filters([
                SelectFilter::make('categorie_id')
                    ->label('Category')
                    ->options(Category::all()->pluck('nom', 'id'))
                    ->query(function (Builder $query, array $data) {
                        if ($data['value']) {
                            $query->where('categorie_id', $data['value']);
                        }
                    }),
                SelectFilter::make('subcategory_id')
                    ->label('Subcategory')
                    ->options(Subcategory::all()->pluck('nom', 'id'))
                    ->query(function (Builder $query, array $data) {
                        if ($data['value']) {
                            $query->where('subcategory_id', $data['value']);
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListImmobiliers::route('/'),
            'create' => Pages\CreateImmobilier::route('/create'),
            'edit' => Pages\EditImmobilier::route('/{record}/edit'),
           
        ];
    }

    public static function rules(Request $request): array
    {
        return [
            'images.*' => ['nullable', 'image','mimes:jpeg,jpg,png,gif'],
        ];
    }
}

