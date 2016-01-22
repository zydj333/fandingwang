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
class Frontpage {

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
         * @param $url 跳转的地址
	 *
	 *
	 */
	function getPage($totle_count, $page_size, $now_page,$url='/') {
		$totle_page = ceil(intval($totle_count) / intval($page_size));
		$pre_page = intval($now_page) - 1;
		$next_page = intval($now_page) + 1;
		$html='';
		if($now_page==1){
			$html ="<a class='prev' href='javascript:void(0)'>&lt;</a>";
		}else{
			$html ="<a class='prev' href='".$url."/".$pre_page."'>&lt;</a>";
		}

		/* 中间数字循环链接开始 */
		if ($totle_page <= 4) {//当总页数小于等于4时
			for ($i = 1; $i <= $totle_page; $i++) {
				if ($now_page == $i) {
					$html.="<a class='now' href='".$url."/".$i."'>".$i."</a>";
				} else {
					$html.="<a href='".$url."/".$i."'>".$i."</a>";
				}
			}
		}
		if ($totle_page >= 5) {//当总页数大于等于5时
			if ($now_page < 3) {//当 当前页为小于3时，及等于1或者等于2
				for ($i = 1; $i <= 5; $i++) {
					if ($now_page == $i) {
						$html.="<a class='now' href='".$url."/".$i."'>".$i."</a>";
					} else {
						$html.="<a href='".$url."/".$i."'>".$i."</a>";
					}
				}
			} else if ($now_page >= 3 && $now_page <= intval($totle_page) - 2) {//当 当前页大于3且小于总页数减2时
				for ($i = intval($now_page) - 2; $i <= intval($now_page) + 2; $i++) {
					if ($now_page == $i) {
						$html.="<a class='now' href='".$url."/".$i."'>".$i."</a>";
					} else {
						$html.="<a href='".$url."/".$i."'>".$i."</a>";
					}
				}
			} else {
				for ($i = intval($totle_page) - 4; $i <= $totle_page; $i++) {
					if ($now_page == $i) {
						$html.="<a class='now' href='".$url."/".$i."'>".$i."</a>";
					} else {
						$html.="<a href='".$url."/".$i."'>".$i."</a>";
					}
				}
			}
		}

		/* 中间数字循环连接结束 */
		if($totle_page == $now_page){
			$html.="<a class='next' href='javascript:void(0)'>&gt;</a>";
		}else{
			$html.="<a class='next' href='".$url."/".$next_page."'>&gt;</a>";

		}
                $html.="共".$totle_page."页";

		return $html;
	}

}

?>
