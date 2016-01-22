<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pageurl
 *  实现分页效果
 * @author zhangping'an
 * @Create Time    2012-3-17 11:52:51
 */
class Pageurl {
    /**
     *
     * @param 分页参数
     *
     * @ignore $totle_count 总条数
     *
     * @ignore $per_count  每页显示的条数
     *
     * @ignore $now_page  当前第几页
     *
     *
     * <div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>
        <ul class="paginList">
        <li class="paginItem"><a href="javascript:;"><span class="pagepre"></span></a></li>
        <li class="paginItem"><a href="javascript:;">1</a></li>
        <li class="paginItem current"><a href="javascript:;">2</a></li>
        <li class="paginItem"><a href="javascript:;">3</a></li>
        <li class="paginItem"><a href="javascript:;">4</a></li>
        <li class="paginItem"><a href="javascript:;">5</a></li>
        <li class="paginItem more"><a href="javascript:;">...</a></li>
        <li class="paginItem"><a href="javascript:;">10</a></li>
        <li class="paginItem"><a href="javascript:;"><span class="pagenxt"></span></a></li>
        </ul>
     *
     */
    function getPage($totle_count, $page_size, $now_page) {
        $totle_page = ceil(intval($totle_count) / intval($page_size));
        $pre_page = intval($now_page) - 1;
        $next_page = intval($now_page) + 1;
        $html = "<div id='pageurl' class='message' >共<i class='blue'>".$totle_count."</i>条数据 分为<i class='blue'>".$totle_page."</i>页  每页显示<i class='blue'>".$page_size."</i>条 当前第<i class='blue'>".$now_page."</i>页</div>";
        $html.=' <ul class="paginList">';
        if ($now_page != 1) {//是否显示首页
            $html.="<li class='paginItem'><a href='#' onclick='return getPageUrl(1);return false' >首页</a></li>";
        }
        if ($now_page > 1) {//是否显示上一页
            $html.="<li class='paginItem'><a href='#' onclick='return getPageUrl(".$pre_page.");return false' ><span class='pagepre'></span></a></li> ";
        }
        /* 中间数字循环链接开始 */
        if ($totle_page <= 4) {//当总页数小于等于4时
            for ($i = 1; $i <= $totle_page; $i++) {
                if ($now_page == $i) {
                    $html.="<li class='paginItem current' ><a href='#'>" . $i . "</a>  </li>";
                } else {
                    $html.="<li class='paginItem'><a href='#' onclick='return getPageUrl(".$i.");return false'>" . $i . "</a>  </li>";
                }
            }
        }
        if ($totle_page >= 5) {//当总页数大于等于5时
            if ($now_page < 3) {//当 当前页为小于3时，及等于1或者等于2
                for ($i = 1; $i <= 5; $i++) {
                    if ($now_page == $i) {
                        $html.="<li class='paginItem current' ><a href='#'>" . $i . "</a></li> ";
                    } else {
                        $html.="<li class='paginItem'><a href='#' onclick='return getPageUrl(".$i.");return false'>" . $i . "</a> </li>";
                    }
                }
            } else if ($now_page >= 3 && $now_page <= intval($totle_page) - 2) {//当 当前页大于3且小于总页数减2时
                for ($i = intval($now_page) - 2; $i <= intval($now_page) + 2; $i++) {
                    if ($now_page == $i) {
                        $html.="<li class='paginItem current' ><a href='#'>" . $i . "</a></li> ";
                    } else {
                        $html.="<li  class='paginItem'><a href='#' onclick='return getPageUrl(".$i.");return false' >" . $i . "</a></li> ";
                    }
                }
            } else {
                for ($i = intval($totle_page) - 4; $i <= $totle_page; $i++) {
                    if ($now_page == $i) {
                        $html.="<li  class='paginItem current'><a href='#'>" . $i . "</a></li>";
                    } else {
                        $html.="<li  class='paginItem'><a href='#' onclick='return getPageUrl(".$i.");return false'>" . $i . "</a></li> ";
                    }
                }
            }
        }

        /* 中间数字循环连接结束 */
        if ($now_page < $totle_page) {//是否显示下一页
            $html.="<li  class='paginItem'><a href='#' onclick='return getPageUrl(".$next_page.");return false'><span class='pagenxt'></span></a></li>";
        }
        if ($totle_page != $now_page) {//是否显示尾页
            $html.="<li  class='paginItem'><a href='#' onclick='return getPageUrl(".$totle_page.");return false'>末页</a> </li>";
        }
        $html.="</ul></div>";
        return $html;
    }

}

?>
