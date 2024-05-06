<?php

namespace Iplague\Project\Controllers;

use Iplague\Project\Database;
use Iplague\Project\Viewer;
use PDO;

class HomeController
{
    public function index(): void
    {
        $page = 'home';
        $title = 'Home Page';
        $content = 'Home Page';

        $query = "SELECT * FROM ".Database::$table." ORDER BY id DESC";
        $stmt = Database::executeQuery($query);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        $view = new Viewer([
            'page' => $page,
            'title' => $title,
            'content' => $content,
            'data' => $data
        ]);

        $view->render();
    }

    public function handleForm(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /');
            return;
        }

        $name = $this->filterPost('name');
        $age = $this->filterPost('age');

        if ($name === null || $age === null) {
            header('Location: /');
            return;
        }

        $query = "INSERT INTO ".Database::$table." (name, age) VALUES (:name, :age)";
        Database::executeQuery($query, ['name' => $name, 'age' => $age]);

        header('Location: /');
    }

    public function handleFormDelete(): void
    {
        $id = $_GET['id'] ?? null;

        $query = "DELETE FROM ".Database::$table." WHERE id = :id";
        Database::executeQuery($query, ['id' => $id]);

        header('Location: /');
    }

    private function filterPost(string $key): ?string
    {
        return isset($_POST[$key]) && is_string($_POST[$key]) ? htmlspecialchars($_POST[$key]) : null;
    }
}
