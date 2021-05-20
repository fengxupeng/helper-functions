<?php

namespace App;

/**
 * 分页类
 * Class Page
 * @package components\Helper
 */
class Pager
{
    private $count; //总条数
    private $pages; //总页数
    private $current_page = 1;//当前页
    private $limit;// 长度
    private $start = 0;

    /**
     * $length = 10;
     * $_REQUEST['page'] = 2;
     * $page = new PagerLogic($count, $length);
     * var_dump( $page->start, $page->limit);die;
     * Page constructor.
     * @param $count mixed 总条数
     * @param int $limit
     * @param null $request
     */
    public function __construct($count, $limit = 10, $request = null)
    {
        $this->limit = $limit;
        $this->count = $count;
        $this->setCurrentPage($request ? $request : $_REQUEST);
        $this->pages = ceil($this->count / $this->limit);
        // 0--9, 10--19, 20--29
        $this->start = ($this->current_page - 1) * $this->limit;
    }

    /**
     * @param $request
     */
    private function setCurrentPage($request)
    {
        // 没传,默认第1页
        $this->current_page = isset($request['page']) ? (int)$request['page'] : 1;
        // 不能小于0
        $this->current_page = $this->current_page <= 0 ? 1 : $this->current_page;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return false|float
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->current_page;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return float|int
     */
    public function getStart()
    {
        return $this->start;
    }

}
