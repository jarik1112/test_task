<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   9:20 PM
 */

namespace Framework;


use Framework\Interfaces\ConstructorInjectableInterface;
use Framework\Interfaces\IocContainerInterface;
use Framework\Interfaces\UserStorageInterface;

class DbUserStorage implements UserStorageInterface, ConstructorInjectableInterface
{
    /**
     * @var IocContainerInterface
     */
    protected $ioc;

    /**
     * @var \PDO
     */
    protected $connection;

    public function __construct(IocContainerInterface $container)
    {
        $this->ioc = $container;
    }

    /**
     * Get DB connection
     * Lazy load
     *
     * @return \mysqli
     */
    protected function getConnection()
    {
        if (is_null($this->connection)) {
            $dbConfig         = $this->ioc->build('dbConfig');
            $this->connection = new \PDO(
                'mysql:host=localhost;dbname=' . $dbConfig['dbName'],
                $dbConfig['username'],
                $dbConfig['password']
            );
        }
        return $this->connection;
    }

    /**
     * Get user bu ID
     *
     * return array with user data, otherwise false
     *
     * @param integer $id
     * @return array|bool
     */
    public function get($id)
    {
        $db   = $this->getConnection();
        $stmt = $db->prepare('SELECT * FROM user WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Save user data
     *
     * @param array $user
     * @return mixed
     */
    public function save($user)
    {
        $db = $this->getConnection();
    }

    /**
     * Validate user data
     *
     * @param $user
     * @return bool
     */
    public function validate($user)
    {
        $result = empty($user['email']) || empty($user['password']);
        return !$result;
    }


}