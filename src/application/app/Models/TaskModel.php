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

}