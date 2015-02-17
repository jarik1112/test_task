<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 9:17 PM
 */

namespace Framework\Interfaces;


interface UserStorageInterface
{
    /**
     * Get user bu ID
     *
     * return array with user data, otherwise false
     * @param integer $id
     * @return array|bool
     */
    public function get($id);

    /**
     * Save user data
     * @param array $user
     * @return mixed
     */
    public function save($user);

    /**
     * Validate user data
     * @param $user
     * @return bool
     */
    public function validate($user);
}