<?php

namespace App;

class CLI
{
    public static function clearScreen(): void
    {
        echo "\033[2J\033[H";
    }

    public static function showWelcome(string $text = 'Welcome to the Acme Basket App', string $color = 'green'): void
    {
        self::clearScreen();
        self::divider();
        self::printWithColor($text, $color);
        self::divider();
    }

    public static function divider(string $char = '=', int $times = 40, string $color = 'blue'): void
    {
        self::printWithColor(str_repeat($char, $times), $color);
    }

    /**
     * @param array<string> $headers
     * @param array<array<string>> $data
     */
    public static function printTable(
        array $headers,
        array $data,
        string $headerColor = 'magenta',
        string $dataColor = 'blue'
    ): void
    {
        self::divider('-');

        $columnWidths = [];
        foreach ($headers as $i => $header) {
            $columnWidths[$i] = strlen($header);
            foreach ($data as $row) {
                $columnWidths[$i] = max($columnWidths[$i], strlen($row[$i] ?? ''));
            }
        }

        $headerRow = '| ';
        foreach ($headers as $i => $header) {
            $headerRow .= str_pad($header, $columnWidths[$i], ' ') . ' | ';
        }
        self::printWithColor($headerRow, $headerColor);

        foreach ($data as $row) {
            $dataRow = '| ';
            foreach ($headers as $i => $header) {
                $dataRow .= str_pad($row[$i] ?? '', $columnWidths[$i], ' ') . ' | ';
            }
            self::printWithColor($dataRow, $dataColor);
        }

        self::divider('-');
    }

    public static function ask(string $question, string $color = 'blue'): string
    {
        self::printWithColor($question, $color, false);
        return readline() ?: '';
    }

    public static function printWithColor(string $text, string $color = 'white', bool $newLine = true): void
    {
        $colors = [
            'black' => "\033[30m",
            'red' => "\033[31m",
            'green' => "\033[32m",
            'yellow' => "\033[33m",
            'blue' => "\033[34m",
            'magenta' => "\033[35m",
            'cyan' => "\033[36m",
            'white' => "\033[37m"
        ];

        $colorCode = $colors[$color] ?? $colors['white'];
        echo $colorCode . $text . "\033[0m" . ($newLine ? PHP_EOL : '');
    }
}