<?php

namespace App\Helpers\ElasticHelper;

use App\Models\Faq;
use App\Models\Synonym;
use Elasticsearch\Client;

class ElasticHelper
{
    /**
     * @var Client $client
     */
    public $client;

    /**
     * ElasticHelper constructor.
     * @param Client $builder
     */
    public function __construct(Client $builder)
    {
        $this->client = $builder;
    }

    /**
     * @param array $body
     * @return array
     */
    private function bulk($body) {
        $params = [
            'index' => config('elastic.index'),
            'type' => 'faq',
            'body' => $body
        ];
        return $this->client->bulk($params);
    }

    /**
     * @param \Illuminate\Support\Collection $faqs
     * @return array
     */
    public function indexFaqs($faqs) {
        $body = $faqs->map(function($faq) {
            /**
             * @var Faq $faq
             */
            return [
                [
                    'index' => [
                        '_index' => config('elastic.index'),
                        '_type' => 'faq',
                        '_id' => $faq->id
                    ]
                ],
                [
                    'id' => $faq->id,
                    'question' => $faq->question,
                    'paraphrase' => $faq->paraphrases ? explode(',', $faq->paraphrases) : [],
                    'tags' => $faq->tags->pluck('name')->toArray()
                ]
            ];
        })->collapse()->toArray();
        return $this->bulk($body);
    }

    /**
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function searchFaqs($query) {
        $params = [
            'index' => config('elastic.index'),
            'type' => 'faq',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['question', 'paraphrases', 'tags^2'],
                    ],
                ],
                "_source" => [""]
            ]
        ];
        $response =  $this->client->search($params);
        $ids = collect($response['hits']['hits'])->pluck('_id')->toArray();
        $ids_ordered = implode(',', $ids);
        $query = Faq::query()
            ->whereIn('id', $ids);
        if ($ids) {
            $query = $query->orderByRaw("field(id, $ids_ordered)");
        }
        return $query->get();
    }

    /**
     * @param \Illuminate\Support\Collection $ids
     * @return array
     */
    public function deleteFaqs($ids) {
        $body = $ids->map(function($id) {
            return [
                'delete' => [
                    "_index" => config('elastic.index'),
                    '_type' => 'faq',
                    '_id' => $id
                ]
            ];
        })->toArray();
        return $this->bulk($body);
    }
}