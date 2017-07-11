<?php
/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 23/4/2559
 * Time: 9:40
 */


if (!function_exists('dump')) {
    function dump($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF;  color: #000; border: 1px dotted #000; padding: 10px 10px 10px 310px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        } else {
            return $output;
        }
    }
}
if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE)
    {
        dump($var, $label, $echo);
        exit;
    }
}

function escape($string)
{
    return htmlentities($string);
}


if (!function_exists('getFrontendMenu')) {
    function getFrontendMenu($array, $child = FALSE)
    {
        // dump($array);
        $CI =& get_instance();
        $str = "";
        if (count($array)) {
            $str .= $child == FALSE ? '<ul class="nav navbar-nav">' . PHP_EOL : '<ul class="dropdown-menu" role="menu"> ' . PHP_EOL;

            foreach ($array as $item) {
                $name = $CI->uri->segment(1);
                $active = strcasecmp($name, $item['name']) == 0 ? TRUE : FALSE;
                // have parent?
                if (isset($item['children']) && count($item['children'])) {
                    $str .= $active ? '<li class="dropdown active"> ' : '<li class="dropdown"> ';
                    $str .= '<a class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(escape($item['parent_name']) . "/" . escape($item['name'])) . '">' . escape(isEnglishLang() ? $item['title_en'] : $item['title_th']);
                    $str .= '<b class="caret" ></b> </a> ' . PHP_EOL;
                    $str .= getFrontendMenu($item['children'], TRUE);
                } else {
                    $str .= $active ? '<li class="active"> ' : '<li>';
                    $str .= '<a href="' . site_url($item['name']) . '">' . escape(isEnglishLang() ? $item['title_en'] : $item['title_th']) . '</a>';
                }

                $str .= '</li>' . PHP_EOL;
            }

            $str .= '</ul>' . PHP_EOL;
        }

        return $str;
    }
}

function isHasChild($array)
{
    if (count($array) > 0) {
        return true;
    }
    return false;
}

if (!function_exists('isEnglishLang')) {
    function isEnglishLang()
    {
        $CI =& get_instance();
        $language = $CI->session->userdata('language');
        if ($language == "english") {
            return true;
        }
        return false;
    }
}

if (!function_exists('currentLanguage')) {
    function currentLanguage()
    {
        $CI =& get_instance();
        return $CI->session->userdata('language');
    }
}

if (!function_exists('getRoleName')) {
    function getRoleName($role_id)
    {
        $CI =& get_instance();
        switch ($role_id) {
            case 0:
                return "System Admin";
            case 1:
                return "Super Admin";
            case 2:
                return "Admin";
            case 3:
                return "User";
        }

    }
}
if (!function_exists('get_youtube_id_from_url')) {
    function get_youtube_id_from_url($url)
    {
        if (stristr($url, 'youtu.be/')) {
            preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID);
            return $final_ID[4];
        } else {
            @preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD);
            return $IDD[5];
        }
    }
}
if (!function_exists('IsNullOrEmptyString')) {
    function IsNullOrEmptyString($question)
    {
        return (!isset($question) || trim($question) === '');
    }
}

if (!function_exists('setFormData')) {
    function setFormData($arr_data, $key)
    {
        $ret_data = "";
        $index_th = $key . "_th";
        $index_en = $key . "_en";

        if (isset($arr_data["row"])) {
            //Get match key
            if (array_key_exists($key, $arr_data["row"])) {
                $ret_data = $arr_data["row"][$key];
            } else {
                // Get follow by language
                if (!isEnglishLang()) {
                    if (array_key_exists($index_th, $arr_data["row"])) {
                        $ret_data = $arr_data["row"][$index_th];
                    }
                } else {
                    if (array_key_exists($index_en, $arr_data["row"])) {
                        $ret_data = $arr_data["row"][$index_en];
                    }
                }
            }

        } else if (isset($arr_data[$key])) {
            if (currentLanguage() == LANGUAGE_ENGLISH) {
                if (array_key_exists($index_th, $arr_data)) {
                    $ret_data = $arr_data[$index_th];
                }
            } else if (currentLanguage() == LANGUAGE_THAI) {
                if (array_key_exists($index_en, $arr_data)) {
                    $ret_data = $arr_data[$index_en];
                }
            }
        }

        return $ret_data;
    }
}

if (!function_exists('IsExistFile')) {
    function IsExistFile($file_path)
    {
        if(file_exists($file_path)){
            return true;
        }
        return false;
    }
}

