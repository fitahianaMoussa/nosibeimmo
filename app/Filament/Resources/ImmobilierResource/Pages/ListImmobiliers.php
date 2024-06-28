<?php

namespace App\Filament\Resources\ImmobilierResource\Pages;

use App\Filament\Resources\ImmobilierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImmobiliers extends ListRecords
{
    protected static string $resource = ImmobilierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
