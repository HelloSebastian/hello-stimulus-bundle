<?php


namespace HelloSebastian\HelloStimulusBundle\Util;


trait ControllerNameTrait
{
    /**
     * Transform controller name from "JavaScript" to "HTML" way to specify controller.
     *
     * @param string $controllerName
     * @return string|string[]
     */
    private function transformControllerName($controllerName)
    {
        $tempName = str_replace("_", "-", $controllerName);
        return str_replace("/", "--", $tempName);
    }
}