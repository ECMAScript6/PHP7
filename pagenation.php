 
/**
 * 自定义分页方法
 * @param unknown_type $url     #分页url，页码采用'%s'表示，例如：http://test.jingzheng.com/tags/xxx/%s/
 * @param unknown_type $cur_page        #当前页码
 * @param unknown_type $page_fix        #当前页码前后需要显示多少个页码
 * @param intval $total_rows            #数据总数
 * @param intval $pagesize      #每页显示多少数据
 * @param string $cur_page_calss        #当前页css样式名称
 */
public function pagenation($url, $cur_page=1, $page_fix=2, $total_rows=0, $pagesize=10, $cur_page_calss='disable'){
    #计算总页数
    $pagesize = $pagesize>0?$pagesize:10;
    $total_page = ceil($total_rows / $pagesize);
      
    $code = '';
    if($total_page>1){
        $pager = array();
        #首页
        $pager[] = sprintf( '<ul><li><a href="%s">首页</a></li>', sprintf($url, 1) );
          
        #页码列表
        for($page_num=$cur_page-$page_fix; $page_num<$cur_page+$page_fix; $page_num++){
            if($page_num<1 || $page_num>$total_page){
                continue;
            }
            $pager[] = sprintf( '<li class="%s"><a href="%s">%s</a></li>', ( $page_num==$cur_page?$cur_page_calss:'' ), sprintf($url, $page_num), $page_num );
        }
          
        #末页
        $pager[] = sprintf( '<li><a href="%s">末页</a></li><li>共%s条，第%s/%s页</li></ul>', sprintf($url, $total_page), $total_rows, $cur_page, $total_page );
          
        $code = implode("\\n", $pager);
        unset($pager);
    }
      
    return $code;
}
