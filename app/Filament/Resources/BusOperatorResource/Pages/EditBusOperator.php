<?php

namespace App\Filament\Resources\BusOperatorResource\Pages;

use App\Filament\Resources\BusOperatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusOperator extends EditRecord
{
    protected static string $resource = BusOperatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
