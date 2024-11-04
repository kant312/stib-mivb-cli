<?php

declare(strict_types=1);

namespace Kant312\StibMivbCli;

use Kant312\StibMivb\Client;
use Kant312\StibMivb\Model\TravellersInformation;
use PhpTui\Tui\DisplayBuilder;
use PhpTui\Tui\Extension\Core\Widget\Block\Padding;
use PhpTui\Tui\Extension\Core\Widget\BlockWidget;
use PhpTui\Tui\Extension\Core\Widget\GridWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Layout\Constraint;
use PhpTui\Tui\Text\Text;
use PhpTui\Tui\Text\Title;
use PhpTui\Tui\Widget\Borders;
use PhpTui\Tui\Widget\BorderType;
use PhpTui\Tui\Widget\Direction;

final class App
{
    public static function run(): void
    {
        $client = Client::create(getenv('API_KEY'));
        $travellersInformationRaw = $client->latestTravellersInformation();
        $travellersInformation = array_reduce(
            $travellersInformationRaw,
            fn ($carry, TravellersInformation $item) => $carry .= $item->description->french . "\n",
            '' );

        $display = DisplayBuilder::default()->build();
        $display->clear();
        $display->draw(
            GridWidget::default()
                ->direction(Direction::Vertical)
                ->constraints(
                    Constraint::percentage(20),
                    Constraint::percentage(80),
                )
                ->widgets(
                    BlockWidget::default()
                        ->titles(Title::fromString('Travellers information'))
                        ->padding(Padding::all(2))
                        ->borders(Borders::ALL)
                        ->borderType(BorderType::Rounded)
                        ->widget(ParagraphWidget::fromText(Text::parse(
                            $travellersInformation
                        )))
                )
        );
    }
}