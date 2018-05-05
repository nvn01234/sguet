<?php

namespace App\Helpers\ElasticHelper;

use App\Models\Contact;
use App\Models\Document;
use App\Models\Faq;
use App\Models\Subject;
use Elasticsearch\Client;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

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
     * @param string $type
     * @param array $body
     * @return array
     */
    private function bulk($type, $body) {
        $params = [
            'index' => config('elastic.index'),
            'type' => $type,
            'body' => $body
        ];
        return $this->client->bulk($params);
    }

    private function getType($class) {
        return mb_strtolower(collect(explode('\\', $class))->last());
    }

    public function count() {
        $client = $this->client;
        return collect(['faq', 'contact', 'subject', 'document'])->map(function($type) use ($client) {
            $response = $client->count([
                'index' => config('elastic.index'),
                'type' => $type,
                'body' => []
            ]);
            return "$type = " . $response["count"];
        })->implode(', ');
    }

    //#region reindex
    public function reindexAll() {
        $this->reindexFaqs();
        $this->reindexContacts();
        return "done";
    }

    private function reindex($class) {
        $type = $this->getType($class);
        $this->client->deleteByQuery([
            'index' => config('elastic.index'),
            'type' => $type,
            'body' => []
        ]);
        $this->index(call_user_func([$class, 'all']));
        return "done";
    }

    private function index($class) {
        $type = $this->getType($class);
        $this->index(call_user_func([$class, 'all']));
        return "done";
    }

    public function indexAll() {
        $this->index(Faq::class);
        $this->index(Contact::class);
        return "done";
    }

    public function reindexContacts() {
        return $this->reindex(Contact::class);
    }

    public function reindexFaqs() {
        return $this->reindex(Faq::class);
    }

    public function reindexSubjects() {
        return $this->reindex(Subject::class);
    }

    public function reindexDocuments() {
        return $this->reindex(Document::class);
    }
    //#endregion

    //#region index
    /**
     * @param \Illuminate\Support\Collection $models
     * @return string|null
     */
    public function index($models) {
        if ($models->isNotEmpty()) {
            $class = get_class($models[0]);
            $type = $this->getType($class);
            $body = $models->map(function($model) use ($type) {
                /**
                 * @var mixed $model
                 */
                return [
                    [
                        'index' => [
                            '_index' => config('elastic.index'),
                            '_type' => $type,
                            '_id' => $model->id
                        ]
                    ],
                    $model->toElasticData()
                ];
            })->collapse()->toArray();
            $this->bulk($type, $body);
            return "done";
        }
        return null;
    }
    //#endregion index

    //#region search
    public function searchFaqs($query) {
        return $this->simpleSearchMultiMatch($query, Faq::class, ['question', 'paraphrases', 'tags^2']);
    }

    public function searchContacts($query) {
        return $this->simpleSearchMultiMatch($query, Contact::class, ['name^3', 'description^2', 'phone_cq', 'phone_nr', 'phone_dd', 'fax', 'email']);
    }

    public function searchSubjects($query) {
        return $this->simpleSearchMultiMatch($query, Subject::class, ['code', 'name', 'name_en']);
    }

    public function searchDocuments($query) {
        return $this->simpleSearchMultiMatch($query, Document::class, ['name']);
    }

    private function simpleSearchMultiMatch($query, $class, $fields) {
        $type = $this->getType($class);
        $params = [
            'index' => config('elastic.index'),
            'type' => $type,
            'body' => [
                'size' => call_user_func([$class, 'count']),
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => $fields,
                    ],
                ],
                "_source" => [""]
            ]
        ];
        $response =  $this->client->search($params);
        $ids = collect($response['hits']['hits'])->pluck('_id')->toArray();
        $ids_ordered = implode(',', $ids);
        /**
         * @var Builder $query
         */
        $query = call_user_func([$class, 'query'])->whereIn('id', $ids);
        if ($ids) {
            $query = $query->orderByRaw("field(id, $ids_ordered)");
        }
        return $query->get();
    }
    //#endregion

    //#region delete
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
        return $this->bulk("faq", $body);
    }

    /**
     * @param \Illuminate\Support\Collection $ids
     * @return array
     */
    public function deleteContacts($ids) {
        $body = $ids->map(function($id) {
            return [
                'delete' => [
                    "_index" => config('elastic.index'),
                    '_type' => 'contact',
                    '_id' => $id
                ]
            ];
        })->toArray();
        return $this->bulk("contact", $body);
    }
    //#endregion
}