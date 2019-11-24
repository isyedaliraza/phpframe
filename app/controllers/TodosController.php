<?php
namespace App\Controllers;

use App\Core\App;

class TodosController {
    public function index() {
        $tasks =  App::get('database')->selectAll('todos', 'Task');
        return view('todos', compact('tasks'));
    }

    public function addTodo() {
        App::get('database')->insert(
            'todos',
            [
                'description' => $_POST['description'],
                'completed' => 0
            ]
        );

        return header('Location: /todos');
    }
}