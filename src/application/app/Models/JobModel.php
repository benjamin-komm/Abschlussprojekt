<?php declare(strict_types=1);

namespace app\Models;

use core\MVC\Model;

class JobModel extends Model {

    private string $table = "Job";

    public function getAllJobs() {
        $result = $this->query("SELECT job_id, job_name FROM " . $this->table . ";");
        return empty($result) ? null : $result;
    }

}