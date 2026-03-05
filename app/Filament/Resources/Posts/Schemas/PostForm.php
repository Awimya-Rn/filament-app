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
                    ->description('Fill in the details of the post.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Group::make([
                            TextInput::make('title')
                                ->rules('required | min:3')
                                ->maxLength(255)
                                ->validationMessages([
                                    'required' => 'Judul postingan tidak boleh kosong.',
                                    'min' => 'Judul terlalu pendek, minimal harus 5 karakter ya.',
                                ])
                                ->label('Post Title'),

                            TextInput::make('slug')
                                ->rules('required')
                                ->minLength(3)
                                ->unique(ignoreRecord: true)
                                ->validationMessages([
                                    'unique' => 'Slug ini sudah dipakai, coba kombinasi kata yang lain.',
                                    'min' => 'Slug minimal 3 karakter biar lebih oke.',
                                    'required' => 'Slug/URL wajib diisi.'
                                ])
                                ->label('Slug / URL'),

                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required()
                                ->preload()
                                ->searchable()
                                ->label('Category'),

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
                                ->required()
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
