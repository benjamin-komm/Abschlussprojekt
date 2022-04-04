<?php declare(strict_types=1);

namespace app\Controller;

use app\Models\EmployeeModel;
use app\Models\JobModel;
use core\MVC\FrontController;

class EmployeesController extends FrontController {

    public function indexAction() {
        $employeeModel = new EmployeeModel($this->getConfig());
        $jobModel = new JobModel($this->getConfig());

        $jobs = $jobModel->getAllJobs();
        $employeeList = $employeeModel->getEmployeeList();

        if ($employeeList !== null) {
            foreach ($employeeList as &$employee) {
                $jobName = $this->findJobName($jobs, (int)$employee['employee_job_id']);
                $employee['employee_job_name'] = $jobName;
            }
        }

        $this->getView()->assign('employeeList', $employeeList);
        $this->getView()->assign('jobs', $jobs);

        $this->getView()->addView('EmployeesView.phtml');
        return $this->getView()->render();
    }

    public function addEmployeeAction() {
        $firstname = $_GET['firstname'] ?? null;
        $lastname = $_GET['lastname'] ?? null;
        $jobID = $_GET['job'] ?? null;
        $uploaded = false;

        if ($firstname !== null && $lastname !== null && $jobID !== null && (int)$jobID !== 0) {
            // add new employee
            $employeeModel = new EmployeeModel($this->getConfig());
            $employeeModel->addEmployee($firstname, $lastname, (int)$jobID);
            $uploaded = true;
        }

        $jobModel = new JobModel($this->getConfig());
        $jobs = $jobModel->getAllJobs();

        $this->getView()->assign('jobs', $jobs);
        $this->getView()->assign('uploaded', $uploaded);

        $this->getView()->addView('AddEmployeeView.phtml');
        return $this->getView()->render();
    }

    public function editEmployeeAction() {
        $firstname = $_GET['firstname'] ?? null;
        $lastname = $_GET['lastname'] ?? null;
        $jobID = $_GET['job'] ?? null;
        $employeeID = $_GET['employeeID'] ?? null;
        $foundEmployee = false;
        $uploaded = false;
        $employeeModel = new EmployeeModel($this->getConfig());

        if ($employeeID != null && (int)$employeeID != 0 && $employeeModel->getEmployee((int)$employeeID) != null) {
            $foundEmployee = true;
            $this->getView()->assign('employeeData', $employeeModel->getEmployee((int)$employeeID));
        }

        if ($firstname !== null && $lastname !== null && $jobID !== null && (int)$jobID !== 0 && $foundEmployee) {
            $employeeModel = new EmployeeModel($this->getConfig());
            $employeeModel->editEmployee((int)$employeeID, $firstname, $lastname, (int)$jobID);
            $uploaded = true;
        }

        $jobModel = new JobModel($this->getConfig());
        $jobs = $jobModel->getAllJobs();

        $this->getView()->assign('jobs', $jobs);
        $this->getView()->assign('uploaded', $uploaded);
        $this->getView()->assign('foundEmployee', $foundEmployee);

        $this->getView()->addView('EditEmployeeView.phtml');
        return $this->getView()->render();
    }

    public function deleteEmployeeAction() {
        $foundEmployee = false;
        $uploaded = false;
        $employeeID = $_GET['employeeID'] ?? null;
        $deleteConfirm = $_GET['delete_confirm'] ?? null;
        $employeeModel = new EmployeeModel($this->getConfig());

        if ($employeeID != null && (int)$employeeID != 0 && $employeeModel->getEmployee((int)$employeeID) != null) {
            $foundEmployee = true;
            $this->getView()->assign('employeeData', $employeeModel->getEmployee((int)$employeeID));
        }

        if ($deleteConfirm !== null && $deleteConfirm == "true") {
            $deleteConfirm = true;
            $employeeModel->deleteEmployee((int)$employeeID);
        } else {
            $deleteConfirm = false;
        }

        $this->getView()->assign('deleteConfirm', $deleteConfirm);
        $this->getView()->assign('foundEmployee', $foundEmployee);
        $this->getView()->addView('DeleteEmployeeView.phtml');
        return $this->getView()->render();
    }

    /**
     * find job name by job id. Doing this with php is maybe better for performance with a high amount of employees
     * @param array $jobs
     * @param int $jobID
     * @return string|null
     */
    private function findJobName(array $jobs, int $jobID): ?string {
        foreach ($jobs as $job) {
            if ((int)$job['job_id'] === $jobID) {
                return $job['job_name'];
            }
        }
    }

}