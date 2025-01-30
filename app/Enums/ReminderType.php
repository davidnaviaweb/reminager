<?php

namespace App\Enums;

enum ReminderType: string
{
    case TASK = 'task';
    case EVENT = 'event';

    /**
     * @param string $value
     * @return string[]
     * @throws \Exception
     */
    public static function getConfig(string $value): array
    {
        return match ($value) {
            self::TASK->value => ['label' => 'Task', 'icon' => 'c-pencil-square'],
            self::EVENT->value => ['label' => 'Event', 'icon' => 's-calendar'],
            default => throw new \Exception('Unexpected match value'),
        };
    }

    /**
     * @return ReminderType[]
     */
    public static function getValues(): array
    {
        return [
            self::TASK->value,
            self::EVENT->value,
        ];
    }

    /**
     * @return bool
     */
    public function isTask(): bool
    {
        return $this->value == self::TASK;
    }

    /**
     * @return bool
     */
    public function isEvent(): bool
    {
        return $this->value == self::EVENT;
    }
}
