<?php

namespace App\Search;

use TeamTNT\TNTSearch\TNTSearch;
use Illuminate\Database\Capsule\Manager;

class Builder
{
    protected $tnt;

    protected $model;

    protected $results;

    /**
     * Undocumented function
     *
     * @param TNTSearch $tnt
     * @param [type] $model
     */
    public function __construct(TNTSearch $tnt, $model)
    {
        $this->tnt = $tnt;
        $this->model = $model;
    }

    /**
     * Undocumented function
     *
     * @param [type] $q
     * @param integer $limit
     * @return void
     */
    public function search($q, $limit = 12)
    {
        $this->tnt->selectIndex($this->model::SEARCH_INDEX);

        $this->results = $this->tnt->search($q, $limit);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function raw()
    {
        return $this->results;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function get()
    {
        ['ids' => $ids] = $this->results;

        return $this->model::whereIn('id', $ids)
            ->orderBy(Manager::connection()->raw('FIELD(id, ' . implode(',', $ids) . ')'))
            ->get();
    }
}