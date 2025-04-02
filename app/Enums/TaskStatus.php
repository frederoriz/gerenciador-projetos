<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';

    /**
     * Retorna a label do status do produto.
     *
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pendente',
            self::COMPLETED => 'Concluído',
        };
    }

    /**
     * Retorna o valor do status do produto em formato de array.
     *
     * @return array
     */
    public static function list(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->label()];
        })->toArray();
    }
}