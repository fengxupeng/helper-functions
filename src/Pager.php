<?php

namespace App;

/**
 * 分页类
 * Class Page
 * @package components\Helper
 */
class Pager
{
    public $count; //总条数
    public $pages; //总页数
    public $current_page = 1;//当前页
    public $limit;// 长度
    public $start = 0;

    /**
     * Page constructor.
     * @param $count int 总条数
     * @param int $limit
     */
    public function __construct($count, $limit = 10)
    {
        $this->limit = $limit;
        $this->count = $count;
        $this->setCurrentPage($_REQUEST);
        $this->pages = ceil($this->count / $this->limit);
        // 0--9, 10--19, 20--29
        $this->start = ($this->current_page - 1) * $this->limit;
    }

    /**
     * @param $request
     */
    public function setCurrentPage($request)
    {
        // 没传,默认第1页
        $this->current_page = isset($request['page']) ? (int)$request['page'] : 1;
        // 不能小于0
        $this->current_page = $this->current_page <= 0 ? 1 : $this->current_page;
    }

    /**
     * @return array
     */
    public function ret()
    {
        return [
            'pages' => $this->pages,
            'count' => $this->count,
            "start" => $this->start
        ];
    }

}
