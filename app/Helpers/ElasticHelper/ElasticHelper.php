<?php

namespace App\Helpers\ElasticHelper;

use App\Models\Contact;
use App\Models\Faq;
use App\Models\Subject;
use Elasticsearch\Client;
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

    public function reindex() {
        $this->reindexFaqs();
        $this->reindexContacts();
        return "done";
    }

    public function reindexContacts() {
        $this->client->deleteByQuery([
            'index' => config('elastic.index'),
            'type' => 'contact',
            'body' => []
        ]);
        $this->indexContacts(Contact::all());
        return "done";
    }

    public function reindexFaqs() {
        $this->client->deleteByQuery([
            'index' => config('elastic.index'),
            'type' => 'faq',
            'body' => []
        ]);
        $this->indexFaqs(Faq::all());
        return "done";
    }

    public function indexSubjects() {
        $subjects = Subject::all();
        $body = $subjects->map(function($subject) {
            /**
             * @var Subject $subject
             */
            return [
                [
                    'index' => [
                        '_index' => config('elastic.index'),
                        '_type' => 'subject',
                        '_id' => $subject->id
                    ]
                ],
                $subject->toElasticData()
            ];
        })->collapse()->toArray();
        $this->bulk("subject", $body);
        return "done";
    }

    public function count() {
        $client = $this->client;
        return collect(['faq', 'contact'])->map(function($type) use ($client) {
            $response = $client->count([
                'index' => config('elastic.index'),
                'type' => $type,
                'body' => []
            ]);
            return "$type = " . $response["count"];
        })->implode(', ');
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
        return $this->bulk("faq", $body);
    }

    /**
     * @param \Illuminate\Support\Collection $contacts
     * @return array
     */
    public function indexContacts($contacts) {
        $body = $contacts->map(function($contact) {
            /**
             * @var Contact $contact
             */
            return [
                [
                    'index' => [
                        '_index' => config('elastic.index'),
                        '_type' => 'contact',
                        '_id' => $contact->id,
                    ],
                ],
                [
                    'id' => $contact->id,
                    'name' => $contact->name,
                    'description' => $contact->description,
                    'phone_cq' => $contact->phone_cq,
                    'phone_nr' => $contact->phone_nr,
                    'phone_dd' => $contact->phone_dd,
                    'fax' => $contact->fax,
                    'email' => $contact->email,
                ]
            ];
        })->collapse()->toArray();
        return $this->bulk('contact', $body);
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
                'size' => Faq::count(),
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
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function searchContacts($query) {
        $params = [
            'index' => config('elastic.index'),
            'type' => 'contact',
            'body' => [
                'size' => Contact::count(),
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['name^3', 'description^2', 'phone_cq', 'phone_nr', 'phone_dd', 'fax', 'email'],
                    ],
                ],
                "_source" => [""]
            ]
        ];
        $response =  $this->client->search($params);
        $ids = collect($response['hits']['hits'])->pluck('_id')->toArray();
        $ids_ordered = implode(',', $ids);
        $query = Contact::query()
            ->whereIn('id', $ids);
        if ($ids) {
            $query = $query->orderByRaw("field(id, $ids_ordered)");
        }
        return $query->get();
    }

    public function searchSubjects($query) {
        $params = [
            'index' => config('elastic.index'),
            'type' => 'subject',
            'body' => [
                'size' => Subject::count(),
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['code', 'name', 'name_en'],
                    ],
                ],
                "_source" => [""]
            ]
        ];
        $response =  $this->client->search($params);
        $ids = collect($response['hits']['hits'])->pluck('_id')->toArray();
        $ids_ordered = implode(',', $ids);
        $query = Contact::query()
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
}