<?php

namespace App\Filament\Resources\BusClassResource\Pages;

use App\Filament\Resources\BusClassResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusClasses extends ListRecords
{
    protected static string $resource = BusClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
