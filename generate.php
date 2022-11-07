#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('generate');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $interfaces = collect(json_decode(
            json: json_decode(
                json: file_get_contents(__DIR__.'/tests/Fixtures/Saloon/api.steampowered.com/GET/ISteamWebAPIUtil/GetSupportedAPIList/v1.json'),
                associative: true,
                depth: 512,
                flags: JSON_THROW_ON_ERROR
            )['data'],
            associative: true,
            depth: 512,
            flags: JSON_THROW_ON_ERROR
        )['apilist']['interfaces']);

        $buffer = new BufferedOutput();

        $style = new TableStyle();
        $style->setDefaultCrossingChar('|');
        $style->setCellHeaderFormat('<info>%s</info>');

        $table = new Table($buffer);
        $table->setStyle($style);

        $table->setHeaders([
            '',
            'Method',
            'Path',
        ]);

        $interfaces->each(static function (array $interface) use ($table): void {
            collect($interface['methods'])->each(static function (array $method) use ($table, $interface): void {
                $table->addRow([
                    '' => '❓️',
                    'method' => "**{$method['httpmethod']}**",
                    'path' => '`'.implode('/', [
                        $interface['name'],
                        $method['name'],
                        "v{$method['version']}",
                    ]).'`',
                ]);
            });
        });

        $table->render();

        $lines = explode("\n", $buffer->fetch());
        array_shift($lines);
        array_pop($lines);
        array_pop($lines);
        $output->writeln($lines);

        return self::SUCCESS;
    }
}

class ConsoleApplication extends Application
{
    public function __construct()
    {
        parent::__construct('astrotomic\steam-sdk generator', '1.0.0');

        $this->add(new GenerateCommand());
        $this->setDefaultCommand('generate', true);
    }

    public function getLongVersion(): string
    {
        return parent::getLongVersion().' by <comment>Astrotomic</comment>';
    }
}

$app = new ConsoleApplication();
$app->run();
