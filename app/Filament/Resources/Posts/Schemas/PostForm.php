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
                ->Description('Fiil in the details of the post.')
                ->icon('heroicon-o-document-text')
                ->schema([
                    Group::make([
                        TextInput::make('title')->required()->minLength(5),
                        TextInput::make('slug')->required()->unique(ignoreRecord:true),
                        Select::make('category_id')
                            ->relationship('category','name')
                            ->preload()
                            ->searchable(),
                        ColorPicker::make('color'),
                    ])->columns(2),
                    MarkdownEditor::make('content'),
                ])->columnSpan(2),
                Group::make([
                    Section::make('Image Upload')->schema([
                        FileUpload::make('image')
                            ->disk('public')
                            ->directory('posts'),
                    ]),
                    Section::make('Meta Information')->schema([
                        // RichEditor::make('content'),
                            TagsInput::make('tags'),
                            Checkbox::make('published'),
                            DateTimePicker::make('published_at'),
                    ]),
                ])->columnSpan(1),
            // ])->columns(3);
            ])->columns(3);
    }
}
