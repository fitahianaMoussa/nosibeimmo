<?php

namespace App\Filament\Resources\ImmobilierResource\Pages;

use App\Filament\Resources\ImmobilierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImmobilier extends EditRecord
{
    protected static string $resource = ImmobilierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
