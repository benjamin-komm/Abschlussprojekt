<?php declare(strict_types = 1);
namespace core\MVC;

use core\ProjectConfig;
use mysqli;

class Model {

    private ProjectConfig $config;

    private string $host;
    private int    $port;
    private string $dbname;
    private string $user;
    private string $password;

    /**
     * Model constructor.
     * @param ProjectConfig $config
     */
    public function __construct(ProjectConfig $config) {
        $this->config = $config;
        $this->host = $config->get('database', 'host');
        $this->port = (int)$config->get('database', 'port');
        $this->dbname = $config->get('database', 'dbname');
        $this->user = $config->get('database', 'user');
        $this->password = $config->get('database', 'password');
    }

    /**
     * @param string $sql
     * @return array
     */
    protected function query(string $sql): array {
        $connection = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port);

        if ($connection->connect_error) {
            if (true) { // TODO add debuge mode -> if debug mode off run fallback controller
                dd('Failed to connect to MySQL: ' . $connection->connect_error);
            } else {
                // TODO implement Fallback Controller
                exit();
            }
        }
//        $connection->set_charset('utf8');
        $connection->set_charset('utf8mb4');

        $result = $connection->query($sql);

        if (!$result) {
            var_dump("\nSQL Error");
            var_dump("\nCode: " . $sql);
            var_dump("\nError: " . $connection->error);
            die(); // TODO Error Controller
        }

        $data = [];
        if (!is_bool($result)) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        $connection->close();
        return $data;
    }

}