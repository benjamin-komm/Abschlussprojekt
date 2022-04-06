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

    public function showProjectAction() {
        $projectID = $_GET['projectID'] ?? null;
        $projectModel = new ProjectModel($this->getConfig());
        $foundProject = false;
        $completedTasks = 0;
        $totalTasks = 0;
        $taskModel = new TaskModel($this->getConfig());

        if ($projectID != null && (int)$projectID != 0 && $projectModel->getProject((int)$projectID) != null) {
            $foundProject = true;
            $this->getView()->assign('projectData', $projectModel->getProject((int)$projectID));
        }

        $taskID = $_GET['taskID'] ?? null;
        $taskAction = $_GET['taskAction'] ?? null;
        if ($taskID !== null && (int)$taskID !== 0 && $taskModel->getTask((int)$taskID) !== null && $taskAction !== null && array_search($taskAction, ["unfinished", "finished"]) !== false) {
            if ($taskAction == 'finished') {
                $taskModel->setTaskToFinished((int)$taskID);
            } else {
                $taskModel->setTaskToUnfished((int)$taskID);
            }
        }

        if ($foundProject && $taskModel->getProjectTasks((int)$projectID)) {
            $tasks = $taskModel->getProjectTasks((int)$projectID);
            if ($tasks !== null) {
                foreach ($tasks as $task) {
                    if ($task['task_done'] == 1) $completedTasks++;
                }
            }
            $totalTasks = ($tasks == null) ? 0 : count($tasks);
            $this->getView()->assign('tasks', $tasks);
        } else {
            $this->getView()->assign('tasks', null);
        }

        $this->getView()->assign('completedTasks', $completedTasks);
        $this->getView()->assign('totalTasks', $totalTasks);
        $this->getView()->assign('foundProject', $foundProject);
        $this->getView()->addView('ShowProjectView.phtml');
        return $this->getView()->render();
    }

    public function addProjectTaskAction() {
        $projectID = $_GET['projectID'] ?? null;
        $taskName = $_GET['task_name'] ?? null;
        $taskDescription = $_GET['task_description'] ?? null;
        $projectModel = new ProjectModel($this->getConfig());
        $foundProject = false;
        $uploaded = false;

        if ($projectID != null && (int)$projectID != 0 && $projectModel->getProject((int)$projectID) != null) {
            $foundProject = true;
            $this->getView()->assign('projectID', (int)$projectID);
        }

        if ($taskName !== null && $taskDescription !== null) {
            $taskModel = new TaskModel($this->getConfig());
            $taskModel->addTask((int)$projectID, $taskName, $taskDescription);
            $uploaded = true;
        }

        $this->getView()->assign('uploaded', $uploaded);
        $this->getView()->assign('foundProject', $foundProject);
        $this->getView()->addView('AddProjectTaskView.phtml');
        return $this->getView()->render();
    }

}