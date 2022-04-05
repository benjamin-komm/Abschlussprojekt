<?php declare(strict_types=1);

namespace app\Controller;

use app\Models\ProjectModel;
use app\Models\TaskModel;
use core\MVC\FrontController;

class ProjectsController extends FrontController {

    public function indexAction() {
        $projectModel = new ProjectModel($this->getConfig());
        $taskModel = new TaskModel($this->getConfig());
        $projects = $projectModel->getProjects();

        if ($projects !== null) {
            foreach ($projects as &$project) {
                $tasks = $taskModel->getProjectTasks((int)$project['project_id']);
                $completedTasks = 0;
                if ($tasks !== null) {
                    foreach ($tasks as $task) {
                        if ($task['task_done'] == 1) $completedTasks++;
                    }
                }
                $project['completedTasks'] = $completedTasks;
                $project['totalTasks'] = ($tasks == null) ? 0 : count($tasks);
            }
        }

        $this->getView()->assign('projects', $projects);
        $this->getView()->addView('ProjectsView.phtml');
        return $this->getView()->render();
    }

    public function addProjectAction() {
        $projectname = $_GET['projectname'] ?? null;
        $description = $_GET['description'] ?? null;
        $uploaded = false;

        if ($projectname !== null && $projectname !== null) {
            // add new project
            $projectModel = new ProjectModel($this->getConfig());
            $projectModel->addProject($projectname, $description);
            $uploaded = true;
        }

        $this->getView()->assign('uploaded', $uploaded);
        $this->getView()->addView('AddProjectView.phtml');
        return $this->getView()->render();
    }

}