<?php

namespace App\Enums;

enum ReminderStatus: string
{
    case COMPLETED = 'completed';
    case IN_PROGRESS = 'in_progress';
    case PENDING = 'pending';

    /**
     * @param string $value
     * @return string[]
     * @throws \Exception
     */
    public static function getConfig(string $value): array
    {
        return match ($value) {
            self::COMPLETED->value => [
                'label' => 'Completed',
                'bg-color' => '#28a745'
            ],
            self::IN_PROGRESS->value => [
                'label' => 'In progress',
                'bg-color' => '#ffc107'
            ],
            self::PENDING->value => [
                'label' => 'Pending',
                'bg-color' => '#dc3545'
            ],
            default => throw new \Exception('Unexpected match value'),
        };
    }

    /**
     * @return ReminderStatus[]
     */
    public static function getValues(): array
    {
        return [
            self::COMPLETED,
            self::IN_PROGRESS,
            self::PENDING,
        ];
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->value == self::PENDING;
    }

    /**
     * @return bool
     */
    public function isInProgress(): bool
    {
        return $this->value == self::IN_PROGRESS;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->value == self::COMPLETED;
    }
}
