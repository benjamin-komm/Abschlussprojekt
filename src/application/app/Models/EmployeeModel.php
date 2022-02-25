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
     * get all employees
     * @return array|null
     */
    public function getEmployeeList(): ?array {
        $list = $this->query('SELECT * FROM ' . $this->table . ';');
        return empty($list) ? null : $list;
    }

}