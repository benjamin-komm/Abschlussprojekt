<?php declare(strict_types=1);

namespace app\Models;

use core\MVC\Model;

class EmployeeModel extends Model {

    private string $table = 'Employee';

    /**
     * Add a new employee
     * @param string $firstname
     * @param string $lastname
     * @param int $jobID
     * @return void
     */
    public function addEmployee(string $firstname, string $lastname, int $jobID) {
        $this->query("INSERT INTO " . $this->table . " (employee_firstname, employee_lastname, employee_job_id) 
                VALUES ('" . $firstname . "', '" . $lastname . "', " . $jobID . ");");
    }

    /**
     * Get employee by id
     * @param int $employeeID
     * @return array|null
     */
    public function getEmployee(int $employeeID): ?array {
        $response = $this->query('SELECT * FROM ' . $this->table . ' WHERE employee_id = ' . $employeeID . ';');
        return empty($response) ? null : $response[0];
    }

    /**
     * Delete employee by id
     * @param int $employeeID
     * @return void
     */
    public function deleteEmployee(int $employeeID) {
        $this->query('DELETE FROM ' . $this->table . ' WHERE employee_id = ' . $employeeID . ';');
    }

    /**
     * edit the data from a specific employee
     * @param int $employeeID
     * @param string $firstname
     * @param string $lastname
     * @param int $jobID
     * @return void
     */
    public function editEmployee(int $employeeID, string $firstname, string $lastname, int $jobID) {
        $this->query('UPDATE ' . $this->table . ' SET employee_firstname = "' . $firstname . '", employee_lastname = "' . $lastname . '", employee_job_id = ' . $jobID . ' WHERE employee_id = ' . $employeeID . ';');
    }

    /**
     * get all employees
     * @return array|null
     */
    public function getEmployeeList(): ?array {
        $list = $this->query('SELECT * FROM ' . $this->table . ';');
        return empty($list) ? null : $list;
    }

}