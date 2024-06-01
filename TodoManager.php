<?php

require 'TodoItem.php';

class TodoManager
{
    private array $todos = [];
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->loadFromFile();
    }
    public function addTodoItem(string $name): void
    {
        $nextId = $this->getNextId();
        $item = new TodoItem($nextId, $name);
        $this->todos[] = $item;
        $this->saveToFile();
    }
    public function getTodoItems(): array
    {
        return $this->todos;
    }
    public function markTodoAsComplete(int $id): void
    {
        foreach ($this->todos as $todo) {
            if ($todo->getId() === $id) {
                $todo->markAsComplete();
                $this->saveToFile();
                return;
            }
        }
    }
    public function deleteTodoItem(int $id): void
    {
        $this->todos = array_filter($this->todos, fn($todo) => $todo->getId() !== $id);
        $this->saveToFile();
    }

    private function loadFromFile(): void
    {
        if (file_exists($this->filePath)) {
            $data = json_decode(file_get_contents($this->filePath), true);
            if ($data) {
                $this->todos = array_map([TodoItem::class, 'fromArray'], $data);
            }
        }
    }

    private function saveToFile(): void
    {
        $data = array_map(fn($todo) => $todo->toArray(), $this->todos);
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    private function getNextId(): int
    {
        $ids = array_map(fn($todo) => $todo->getId(), $this->todos);
        return $ids ? max($ids) + 1 : 1;
    }
}
