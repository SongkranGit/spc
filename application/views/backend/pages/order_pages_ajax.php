<?php


//  dump($pages);
echo get_ol($pages);

function get_ol($array, $child = FALSE)
{
    $str = "";
    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';

        foreach ($array as $item) {
            $title = (isEnglishLang())?$item['title_en']:$item['title_th'];

            $str .= '<li id="list_' . $item['id'] . ' ">';
            $str .= '<div>' . $title . '</div>';

            if (isset($item['children']) && count($item['children'])) {
                $str .= get_ol($item['children'], TRUE);
            }

            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ol>' . PHP_EOL;
    }

    return $str;
}

?>

<style>
    ol.sortable, ol.sortable ol {
        margin: 0 0 0 25px;
        padding: 0;
        list-style-type: none;
    }

    ol.sortable {
        margin: 10px 0 10px 0;
    }

    .sortable li {
        margin: 5px 0 0 0;
        padding: 0;
    }

    .sortable li div {
        border: 1px solid #d4d4d4;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        border-color: #D4D4D4 #D4D4D4 #BCBCBC;
        padding: 6px;
        margin: 0;
        cursor: move;
        background: #f6f6f6;
        background: -moz-linear-gradient(top, #ffffff 0%, #f6f6f6 47%, #ededed 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff),
        color-stop(47%, #f6f6f6), color-stop(100%, #ededed));
        background: -webkit-linear-gradient(top, #ffffff 0%, #f6f6f6 47%, #ededed 100%);
        background: -o-linear-gradient(top, #ffffff 0%, #f6f6f6 47%, #ededed 100%);
        background: -ms-linear-gradient(top, #ffffff 0%, #f6f6f6 47%, #ededed 100%);
        background: linear-gradient(to bottom, #ffffff 0%, #f6f6f6 47%, #ededed 100%);
        filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#ffffff',
        endColorstr='#ededed', GradientType=0);
    }

    .sortable li.mjs-nestedSortable-branch div {
        background: -moz-linear-gradient(top, #ffffff 0%, #f6f6f6 47%, #f0ece9 100%);
        background: -webkit-linear-gradient(top, #ffffff 0%, #f6f6f6 47%, #f0ece9 100%);
    }

    .sortable li.mjs-nestedSortable-leaf div {
        background: -moz-linear-gradient(top, #ffffff 0%, #f6f6f6 47%, #bcccbc 100%);
        background: -webkit-linear-gradient(top, #ffffff 0%, #f6f6f6 47%, #bcccbc 100%);
    }

    .sortable li.mjs-nestedSortable-collapsed>ol {
        display: none;
    }

    .sortable li.mjs-nestedSortable-branch>div>.disclose {
        display: inline-block;
    }

    .sortable li.mjs-nestedSortable-collapsed>div>.disclose>span:before {
        content: '+ ';
    }

    .sortable li.mjs-nestedSortable-expanded>div>.disclose>span:before {
        content: '- ';
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $('.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            maxLevels: 2
        });

    });
</script>
