<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 19/4/2559
 * Time: 21:36
 */
class SettingsRepository
{

    /**
     * Call this method to get singleton
     *
     * @return UserFactory
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new UserFactory();
        }
        return $inst;
    }

    /**
     * Private ctor so nobody else can instance it
     *
     */
    private function __construct()
    {
        $CI = get_instance();
        $CI->load>model("");
    }

    public function getWebsiteName(){
        return "";
    }

    public function getDefaultLanguage(){
        return "";
    }

    public function getWebsiteLogoFileName(){
        return "";
    }

    public function getWebsiteShortName(){
        return "";
    }

}