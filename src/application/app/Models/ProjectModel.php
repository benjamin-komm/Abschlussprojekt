<?php declare(strict_types=1);

namespace app\Models;

use core\MVC\Model;

class ProjectModel extends Model {

    private string $table = "Project";

    /**
     * add a new project
     * @param string $projectname
     * @param string $description
     * @return void
     */
    public function addProject(string $projectname, string $description) {
        $this->query('INSERT INTO ' . $this->table . ' (project_name, project_description) VALUES ("' . $projectname . '", "' . $description . '");');
    }

    /**
     * get all projects
     * @return array|null
     */
    public function getProjects(): ?array {
        $response = $this->query('SELECT * FROM ' . $this->table . ';');
        return empty($response) ? null : $response;
    }

    /**
     * get a single project by project id
     * @param int $projectID
     * @return array|null
     */
    public function getProject(int $projectID): ?array {
        $response = $this->query('SELECT * FROM ' . $this->table . ' WHERE project_id = ' . $projectID . ';');
        return empty($response) ? null : $response[0];
    }

}