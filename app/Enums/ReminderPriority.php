<?php

namespace App\Enums;

enum ReminderPriority: string
{
    case LOW = '10';
    case MEDIUM = '100';
    case HIGH = '1000';

    /**
     * @param string $value
     * @return array
     * @throws \Exception
     */
    public static function getConfig(string $value): array
    {
        return match ($value) {
            self::LOW->value => [
                'color' => '#5cb85c',
                'text' => '!',
                'label' => 'Low',
            ],
            self::MEDIUM->value => [
                'color' => '#ffcc00',
                'text' => '!!',
                'label' => 'Medium',
            ],
            self::HIGH->value => [
                'color' => '#ff4d4d',
                'text' => '!!!',
                'label' => 'High',
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
            self::LOW->value,
            self::MEDIUM->value,
            self::HIGH->value,
        ];
    }

    /**
     * @return bool
     */
    public function isLow(): bool
    {
        return $this->value == self::LOW;
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
    public function isHigh(): bool
    {
        return $this->value == self::HIGH;
    }
}
