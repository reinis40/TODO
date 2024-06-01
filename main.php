<?php

require 'TodoManager.php';

$todoManager = new TodoManager('todos.json');

while (true) {
    echo "TODO Application\n";
    echo "1. Add\n";
    echo "2. List\n";
    echo "3. Mark as Complete\n";
    echo "4. Delete\n";
    echo "5. Exit\n";
    $choice = readline("Enter your choice: ");

    switch ($choice) {
        case '1':
            $name = readline("Enter TODO's name: ");
            $todoManager->addTodoItem($name);
            echo "TODO added.\n";
            break;

        case '2':
            $todos = $todoManager->getTodoItems();
            echo "TODO's List:\n";
            echo "ID\tName\t\tState\n";
            echo "--------------------------\n";
            foreach ($todos as $todo) {
                echo $todo->getId() . "\t" . $todo->getName() . "\t\t" . $todo->getState() . "\n";
            }
            break;

        case '3':
            $id = (int)readline("Enter TODO ID to mark as complete: ");
            $todoManager->markTodoAsComplete($id);
            echo "TODO marked as complete.\n";
            break;

        case '4':
            $id = (int)readline("Enter TODO ID to delete: ");
            $todoManager->deleteTodoItem($id);
            echo "TODO deleted.\n";
            break;

        case '5':
            exit();

        default:
            echo "Invalid choice. Please try again.\n";
    }

    echo "\n";
}
