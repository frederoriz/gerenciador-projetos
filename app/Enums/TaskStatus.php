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
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'label' => $this->label(),
        ];
    }
}