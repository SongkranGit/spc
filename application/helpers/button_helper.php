<?php
/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 9/1/2559
 * Time: 20:00
 */


if (!function_exists('buttonSubmit')) {
    function buttonSubmit()
    {
        $CI = &get_instance();
        echo "<button id=\"btn_submit\" type=\"submit\" class=\"btn btn-success btn-custom \"><i class=\"fa fa-save\"></i> " . $CI->lang->line("button_save") . "</button>";
    }
}

if (!function_exists('buttonSubmitCreateOrUpdate')) {
    function buttonSubmitCreateOrUpdate($action)
    {
        $CI = &get_instance();
        if ($action === "create") {
            echo "<button id=\"btn_submit\" type=\"submit\" class=\"btn btn-success btn-custom \"><i class=\"fa fa-save\"></i> " . $CI->lang->line("button_save") . "</button>";
        } else {
            echo "<button id=\"btn_submit\" type=\"submit\" class='btn btn-warning btn-custom '><i class=\"fa fa-edit \"></i> " . $CI->lang->line("button_edit") . "</button>";
        }
    }
}

if (!function_exists('buttonSearch')) {
    function buttonSearch()
    {
        $CI = &get_instance();
        echo "<button id=\"btn_search\" type=\"button\" class=\"btn btn-info \"><i class=\"fa fa-search\"></i> " . $CI->lang->line("button_search") . "</button>";
    }
}

if (!function_exists('buttonCancelWithRedirectPage')) {
    function buttonCancelWithRedirectPage($url)
    {
        $CI = &get_instance();
        if ($url != "") {
            $targetUrl = base_url($url);
            // echo "<button id=\"btn_submit\" type=\"submit\" class='btn btn-danger btn-custom '><i class=\"fa fa-times-circle \"></i> ".$CI->lang->line("button_cancel")."</button>";
            echo "<a href='$targetUrl' class='btn btn-danger btn-custom '><i class=\"fa fa-times-circle\"> </i> " . $CI->lang->line("button_cancel") . "</a>";
        }
    }
}

if (!function_exists('buttonCreate')) {
    function buttonCreate($url)
    {
        $CI = &get_instance();
        if ($url != "") {
            $targetUrl = base_url($url);
            echo "<a href='$targetUrl' class='btn btn-success btn-custom '><i class=\"glyphicon glyphicon-plus\"></i> " . $CI->lang->line("button_create") . "</a>";
        }
    }
}

if (!function_exists('buttonClear')) {
    function buttonClear()
    {
        $CI = &get_instance();
        echo "<button id=\"btn_clear\" type=\"button\" onclick=\"clearForm()\" class=\"btn btn-default btn-custom \"><i class=\"fa fa-refresh\"></i> " . $CI->lang->line("button_clear") . "</button>";
    }
}

?>