<?php

namespace App\Enums;

enum ReminderPriority: string
{
    case HIGH = '1000';
    case MEDIUM = '100';
    case LOW = '10';

    /**
     * @param string $value
     * @return array
     * @throws \Exception
     */
    public static function getConfig(string $value): array
    {
        return match ($value) {
            self::HIGH->value => [
                'color' => '#ff4d4d',
                'text' => '!!!',
                'label' => 'High',
            ],
            self::MEDIUM->value => [
                'color' => '#ffcc00',
                'text' => '!!',
                'label' => 'Medium',
            ],
            self::LOW->value => [
                'color' => '#5cb85c',
                'text' => '!',
                'label' => 'Low',
            ],
            default => [
                'color' => 'gray',
                'text' => '?',
                'label' => 'Unknown',
            ],
        };
    }

    /**
     * @return ReminderPriority[]
     */
    public static function getValues(): array
    {
        return [
            self::HIGH,
            self::MEDIUM,
            self::LOW,
        ];
    }

    /**
     * @return bool
     */
    public function isHigh(): bool
    {
        return $this->value == self::HIGH;
    }

    /**
     * @return bool
     */
    public function isMedium(): bool
    {
        return $this->value == self::MEDIUM;
    }

    /**
     * @return bool
     */
    public function isLow(): bool
    {
        return $this->value == self::LOW;
    }
}
