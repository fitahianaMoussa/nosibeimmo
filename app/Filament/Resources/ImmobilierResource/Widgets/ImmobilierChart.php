<?php

namespace App\Filament\Resources\ImmobilierResource\Widgets;

use Filament\Widgets\ChartWidget;

class ImmobilierChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
