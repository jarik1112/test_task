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
     * Return model columns
     *
     * @return array
     */
    protected function getColumns()
    {
        return array(
            'id',
            'email',
            'first_name',
            'last_name',
            'password',
            'is_email_confirmed',
            'confirm_hash'
        );
    }

    /**
     * Save user data
     *
     * @param array $user
     * @return mixed
     */
    public function save($user)
    {
        $db               = $this->getConnection();
        $toBind           = array();
        $toSql            = array();
        $availableColumns = $this->getColumns();
        $stmt             = null;
        $attrs            = array();
        $passInfo = password_get_info($user['password']);
        if($passInfo['algoName'] == 'unknown'){
            $user['password'] = password_hash($user['password'],PASSWORD_BCRYPT);
        }
        foreach ($user as $attribute => $value) {
            if (in_array($attribute, $availableColumns) && $attribute != 'id') {
                $toBind[':' . $attribute] = $value === "" ? null : $value;
                $toSql[]                  = "`{$attribute}` =:{$attribute} ";
                $attrs[]                  = $attribute;
            }
        }
        if ($toBind) {
            if (isset($user['id'])) {
                // Update
                if ($toSql) {
                    $toBind[':id'] = $user['id'];
                    $sql           = 'UPDATE user SET ' . join(',', $toSql) . ' WHERE id = :id ';
                }
            } else {
                // Insert
                $sql = 'INSERT INTO user(' . join(',', $attrs) . ') VALUES (' . join(',', array_keys($toBind)) . ')';
            }
            $stmt = $db->prepare($sql);
            $stmt->execute($toBind);
            return $stmt->rowCount();
        }
        return false;
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

    public function findBy(array $attributes)
    {
        $user                = array();
        $where               = array();
        $toBind              = array();
        $availableAttributes = $this->getColumns();
        foreach ($attributes as $key => $value) {
            if (in_array($key, $availableAttributes)) {
                $attr          = ':' . $key;
                $where[]       = "`{$key}` = {$attr}";
                $toBind[$attr] = $value;
            }
        }
        if ($where) {
            $stmt = $this->getConnection()->prepare("SELECT * FROM user WHERE " . join(',', $where));
            $stmt->execute($toBind);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        return $user;
    }

}