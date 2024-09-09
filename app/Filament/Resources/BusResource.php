<?php

namespace App\Filament\Resources;

use App\Models\Bus;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\CheckboxColumn;
use App\Filament\Resources\BusResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BusResource\RelationManagers;
use Filament\Forms\Components\DateTimePicker;

class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Buses';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('bus_operator_id')->relationship(name: 'busOperator', titleAttribute: 'name')->required(),
                    Select::make('bus_class_id')->relationship(name: 'busClass', titleAttribute: 'name')->required(),
                    Select::make('from_destination_id')->relationship(name: 'fromDestination', titleAttribute: 'name')->label('From Destination')->required(),
                    Select::make('to_destination_id')->relationship(name: 'toDestination', titleAttribute: 'name')->label('To Destination')->required(),

                ])->columns(2),
                Section::make()->schema([
                    TextInput::make('route')->required(),
                    Select::make('departure_day')
                        ->options([
                            'Sunday' => 'Sunday',
                            'Monday' => 'Monday', 
                            'Tuesday' => 'Tuesday',
                            'Wednesday' => 'Wednesday',
                            'Thursday' => 'Thursday',
                            'Friday' => 'Friday', 
                            'Saturday' => 'Saturday'
                        ])->required(),
                    DateTimePicker::make('departure_time')->required(),
                    DateTimePicker::make('arrival_time')->required(),
                    TextInput::make('price')->numeric()->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('route')->searchable()->sortable(),
                TextColumn::make('departure_day')->searchable()->sortable(),
                TextColumn::make('departure_time')->searchable()->sortable(),
                TextColumn::make('arrival_time')->searchable()->sortable(),
                TextColumn::make('price')->searchable()->sortable(),
                TextColumn::make('toDestination.name')->searchable()->sortable(),
                TextColumn::make('fromDestination.name')->searchable()->sortable(),
                TextColumn::make('busClass.name')->searchable()->sortable(),
                TextColumn::make('busOperator.name')->searchable()->sortable(),

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
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }
}
