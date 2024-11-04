<?php

declare(strict_types=1);

namespace Kant312\StibMivbCli;

use PhpTui\Tui\DisplayBuilder;
use PhpTui\Tui\Extension\Core\Shape\MapResolution;
use PhpTui\Tui\Extension\Core\Shape\MapShape;
use PhpTui\Tui\Extension\Core\Widget\CanvasWidget;

final class App
{
    public static function run(): void
    {
        $display = DisplayBuilder::default()->build();
        $display->clear();
        $display->draw(
            CanvasWidget::fromIntBounds(-180, 180, -90, 90)
            ->draw(MapShape::default()->resolution(MapResolution::High))
        );
    }
}