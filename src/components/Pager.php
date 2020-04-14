<?php

namespace app\components;

/**
 * 分页类
 * Class Page
 * @package components\Helper
 */
class Page
{
    public $count; //总条数
    public $pages; //总页数
    public $current_page = 1;//当前页
    public $limit;// 一页多少条
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

    public function setCurrentPage($request)
    {
        // 没传,默认第1页
        $this->current_page = isset($request['page']) ? (int)$request['page'] : 1;
        // 不能小于0
        $this->current_page = $this->current_page <= 0 ? 1 : $this->current_page;
    }

    public function ret()
    {
        return [
            'pages' => $this->pages,
            'count' => $this->count
        ];
    }

}
