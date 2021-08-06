<?php

namespace App\Http\Livewire;

use App\Models\Exchanges\Exchange;
use Livewire\Component;

class ExchangeList extends Component
{
    public $crypto;

    public $isBuy;

    public $features;

    public $filter;

    public $page;

    private $exchanges;

    protected $queryString = [
        'filter' => [
            'except' => ''
        ],
        'page' => [
            'except' => 1,
        ]
    ];

    private function getExchangesQuery()
    {
        return $this->crypto->exchanges()->orderByPivot(
            $this->isBuy ? 'buy_price' : 'sell_price',
            $this->isBuy ? 'ASC' : 'DESC'
        );
    }

    public function mount($crypto, $isBuy)
    {
        $this->crypto = $crypto;
        $this->isBuy = $isBuy;
        $whereArr = $this->getWhereArrFilter(explode('@', $this->filter));
        $this->exchanges = $this->getExchangesQuery()->where($whereArr)->paginate();
        $this->features = __('exchanges.features');
    }

    public function filterFeatures($feature)
    {
        if (empty($this->filter))
            $features = [];
        else
            $features = explode('@', $this->filter);

        if (in_array($feature, $features)) {
            $features = array_filter($features, fn ($item) => $item != $feature);
        } else {
            $features[] = $feature;
        }

        $this->filter = join('@', $features);

        $whereArr = $this->getWhereArrFilter($features);

        $this->exchanges = $this->getExchangesQuery()->where($whereArr)->paginate();

        $this->page = 1;
    }

    protected function getWhereArrFilter($features)
    {
        $arr = [];

        foreach ($features as $key => $item) {
            if (!is_null($item) && !empty($item))
                $arr[$item] = true;
        }

        return $arr;
    }

    public function render()
    {
        return view('livewire.exchange-list', [
            'exchanges' =>  $this->exchanges,
        ]);
    }
}
