<?php

namespace App\Filament\Resources\ImmobilierResource\Pages;

use App\Filament\Resources\ImmobilierResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateImmobilier extends CreateRecord
{
    protected static string $resource = ImmobilierResource::class;
    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
