<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/18/15
 * @time 12:22 AM
 */

namespace Framework;


use Framework\Interfaces\UserStorageInterface;

class XmlUserStorage implements UserStorageInterface
{
    /**
     * Get user bu ID
     *
     * return array with user data, otherwise false
     *
     * @param integer $id
     * @return array|bool
     */
    public function get($id) { }

    /**
     * Save user data
     *
     * @param array $user
     * @return mixed
     */
    public function save($user)
    {
        $xml = '<?xml version="1.0" standalone="yes"?><user></user>';
        $userXml = new \SimpleXMLElement($xml);
        foreach($user as $key=>$value){
            $userXml->addChild($key,$value);
        }
        $userXml->saveXML(ROOT_DIR.'/user_xml/'.$user['id'].'.xml');
    }

    /**
     * Validate user data
     *
     * @param $user
     * @return bool
     */
    public function validate($user) { }

}