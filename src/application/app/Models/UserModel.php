<?php declare(strict_types = 1);

namespace app\Models;

use core\MVC\Model;

class UserModel extends Model {

    private string $table = 'User';

    public function getUser(string $user, string $password): ?array {
        $response = $this->query('SELECT * FROM ' . $this->table . ' WHERE user_name = "' . $user . '" AND user_password = "' . $password . '";');
        return empty($response) ? null : $response[0];
    }

}