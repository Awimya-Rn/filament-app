<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post Details')
                    ->description('Fiil in the details of the post.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Group::make([
                            TextInput::make('title')
                            // ->required()
                            // ->rules('required | min:3 | max:10')
                            ->rules('required','min:3','max:10')
                            ->maxLength(255)
                            ->label('Post Title'),
                            TextInput::make('slug')
                            ->rules('required')
                            ->unique()
                            ->validationMessages([
                                'unique' => 'Slug harus unik dan tidak boleh sama.',
                            ])
                            ->label('Slug / URL'),
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->preload()
                                ->searchable()
                                ->label('Categori'),
                            ColorPicker::make('color')
                                ->label('Theme Color'),
                        ])->columns(2),

                        MarkdownEditor::make('content')
                            ->label('Post Content')
                            ->columnSpanFull(),
                    ])->columnSpan(2),

                Group::make([
                    Section::make('Media')
                        ->description('Upload featured image.')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('posts')
                                ->image()
                                ->label('Featured Image'),
                        ]),

                    Section::make('Meta & Status')
                        ->description('Publication and label settings.')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            TagsInput::make('tags')
                                ->label('Tags'),
                            Checkbox::make('published')
                                ->label('Publish Now'),
                            DateTimePicker::make('published_at')
                                ->label('Publication Time'),
                        ]),
                ])->columnSpan(1),
            ])->columns(3);
    }
}
