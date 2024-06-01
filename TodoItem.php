<?php

class TodoItem
{
    private int $id;
    private string $name;
    private string $state;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->state = 'incomplete';
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getState(): string
    {
        return $this->state;
    }
    public function markAsComplete(): void
    {
        $this->state = 'complete';
    }
    public function toArray(): array
    {
        return [
              'id' => $this->id,
              'name' => $this->name,
              'state' => $this->state,
        ];
    }
    public static function fromArray(array $data): TodoItem
    {
        return new self($data['id'], $data['name']);
    }
}

