<?php declare(strict_types = 1);

namespace app\Models;

use core\MVC\Model;

class TaskModel extends Model {

    private string $table = "Task";

    /**
     * get all tasks in a project
     * @param int $projectID
     * @return array|null
     */
    public function getProjectTasks(int $projectID): ?array {
        $response = $this->query('SELECT * FROM ' . $this->table . ' WHERE task_project_id = ' . $projectID);
        return empty($response) ? null : $response;
    }

    /**
     * get a specific task by task id
     * @param int $taskID
     * @return array|null
     */
    public function getTask(int $taskID): ?array {
        $response = $this->query('SELECT * FROM ' . $this->table . ' WHERE task_id = ' . $taskID);
        return empty($response) ? null : $response[0];
    }

    /**
     * update a task to finished
     * @param int $taskID
     * @return void
     */
    public function setTaskToFinished(int $taskID) {
        $this->query('UPDATE ' . $this->table . ' SET task_done = 1 WHERE task_id = ' . $taskID . ';');
    }

    /**
     * update a task to unfinished
     * @param int $taskID
     * @return void
     */
    public function setTaskToUnfished(int $taskID) {
        $this->query('UPDATE ' . $this->table . ' SET task_done = 0 WHERE task_id = ' . $taskID . ';');
    }

    /**
     * add a new task
     * @param int $projectID
     * @param string $name
     * @param string $description
     * @return void
     */
    public function addTask(int $projectID, string $name, string $description) {
        $this->query('INSERT INTO ' . $this->table . ' (task_project_id, task_title, task_description) VALUES (' . $projectID . ', "' . $name . '", "' . $description . '");');
    }

}