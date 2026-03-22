<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\BaseUnit;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Uom;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Event;

class ProductForm
{
    public static function generateSku(Get $get, Set $set): void
    {

        $brand = Brand::find($get('brand_id'));
        $category = Category::find($get('category_id'));
        $subcategory = SubCategory::find($get('sub_category_id'));

        if (!$brand || !$category || !$subcategory) {
            return;
        }

        $brandCode = str_pad(substr((string)$brand->id, -3), 3, '0', STR_PAD_LEFT);
        $catCode = str_pad(substr((string)$category->id, -3), 3, '0', STR_PAD_LEFT);
        $subcatCode = str_pad(substr((string)$subcategory->id, -3), 3, '0', STR_PAD_LEFT);

        $lastSku = Product::where('brand_id', $brand->id)
            ->where('category_id', $category->id)
            ->where('sub_category_id', $subcategory->id)
            ->orderBy('id', 'desc')
            ->value('sku');

        $nextNumber = 1;
        if ($lastSku && preg_match('/-(\d+)$/', $lastSku, $matches)) {
            $nextNumber = (int)$matches[1] + 1;
        }

        // Generate SKU with numeric codes (e.g., SKU-123-456-789-001)
        $sku = sprintf('SKU-%s-%s-%s-%03d', $brandCode, $catCode, $subcatCode, $nextNumber);
        $set('sku', $sku);

    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    Section::make([

                        TextInput::make('title')
                            ->label('عنوان محصول')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('base_price')
                            ->label('قیمت اولیه')
                            ->required()
                            ->prefix('$')
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $set('gross_margin', ($get('price') ?? 0) - ($get('base_price') ?? 0));
                            }),

                        TextInput::make('price')
                            ->label('قیمت محصول')
                            ->required()
                            ->prefix('$')
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $set('gross_margin', ($get('price') ?? 0) - ($get('base_price') ?? 0));
                            }),

                        TextInput::make('gross_margin')
                            ->label('حاشیه سود کل')
                            ->required()
                            ->prefix('$')
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $set('gross_margin', ($get('price') ?? 0) - ($get('base_price') ?? 0));
                            })
                            ->afterStateHydrated(function (callable $get, callable $set) {
                                $set('gross_margin', ($get('price') ?? 0) - ($get('base_price') ?? 0));
                            }),

                        Select::make('uom_id')
                            ->relationship('uom', 'code')
                            ->label('واحد اندازه گیری')
                            ->reactive()
                            ->afterStateUpdated(function ($stats, callable $set) {
                                $uom = Uom::with('base_units')->find($stats);

                                if ($uom) {
                                    $set('base_unit', $uom->base_units?->id);
                                    $set('purchase_unit', $uom->id);
                                }
                            })
                            ->afterStateHydrated(function ($stats, callable $set) {
                                $uom = Uom::with('base_units')->find($stats);

                                if ($uom) {
                                    $set('base_unit', $uom->base_units?->id);
                                    $set('purchase_unit', $uom->id);
                                }
                            }),

                        Select::make('base_unit')
                            ->label('واحد پایه')
                            ->reactive()
                            ->options(BaseUnit::pluck('name', 'id')),

                        Select::make('purchase_unit')
                            ->label('واحد خرید')
                            ->reactive()
                            ->options(Uom::pluck('name', 'id')),

                        TextInput::make('conversion_factor')
                            ->label('ضریب تبدیل'),

                        TextInput::make('stock')
                            ->label('موجودی در انبار')
                            ->required()
                            ->numeric()
                            ->dehydrated(),

                        TextInput::make('barcode')
                            ->label('بارکد'),

                        RichEditor::make('description')
                            ->columnSpanFull()
                            ->label('توضیحات محصول'),

                    ])->columns(3),

                ])->columnSpan(2),

                Section::make([
                    FileUpload::make('image')
                        ->label('عکس محصول')
                        ->image()
                        ->directory('Pos\Products'),

                    Select::make('brand_id')
                        ->label('برند محصول')
                        ->relationship('brand','title')
                        ->reactive()
                        ->afterStateUpdated(fn ($state, $set, $get) => self::generateSku($get, $set))
                        ->createOptionForm([

                            TextInput::make('title')->label('عنوان برند'),
                            Toggle::make('is_active')->label('فعال سازی'),
                            FileUpload::make('image')->label('عکس برند')

                        ]),

                    Select::make('category_id')
                        ->relationship('category',
                            'title', fn($query) => $query->where('is_active', true)
                        )
                        ->reactive()
                        ->label('دسته بندی محصول')
                        ->afterStateUpdated(fn ($state, $set, $get) => self::generateSku($get, $set))
                        ->createOptionForm([
                            TextInput::make('title')->label('عنوان دسته بندی'),
                            Toggle::make('is_active')->label('فعال سازی'),
                            FileUpload::make('image')->label('عکس دسته بندی')
                        ]),


                    Select::make('sub_category_id')
                        ->options(function (Get $get) {

                            $categoryId = $get('category_id');

                            if (!$categoryId) return [];

                            return SubCategory::where('category_id', $categoryId)
                                ->pluck('title', 'id');
                        })
                        ->reactive()
                        ->disabled(fn(callable $get) => $get('category_id') === null)
                        ->label('زیر دسته بندی محصول')
                        ->dehydrated()
                        ->afterStateUpdated(fn ($state, $set, $get) => self::generateSku($get, $set))
                        ->createOptionForm([

                            Select::make('category_id')
                                ->label('دسته بندی')
                                ->options(Category::pluck('title', 'id')),

                            TextInput::make('title')->label('عنوان زیر دسته بندی'),
                            Toggle::make('is_active')->label('فعال سازی'),
                            FileUpload::make('image')->label('عکس زیر دسته بندی')

                        ])->createOptionUsing(function (array $data): int{
                            return SubCategory::create($data)->getKey();
                        }),

                    TextInput::make('sku')
                        ->label('واحد نگهداری کالا')
                        ->disabled()
                        ->dehydrated(),

                    Group::make([
                        Toggle::make('is_active')
                            ->label('فعال بودن محصول')
                            ->required(),

                        Toggle::make('in_stock')
                            ->label('موجود بودن محصول')
                            ->required(),
                    ])->columns(2)

                ])->columnSpan(1),

            ])->columns(3);
    }
}
