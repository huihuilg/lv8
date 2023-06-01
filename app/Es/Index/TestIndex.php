<?php

use Elasticsearch\ClientBuilder;

class TestIndex
{
    public function createIndex()
    {
        $client = ClientBuilder::create()->setHosts(config('database.connections.elasticsearch.hosts'))->build();

        $params = [
            'index' => 'my_index',
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => [
                    'properties' => [
                        'title' => [
                            'type' => 'text',
                        ],
                        'body' => [
                            'type' => 'text',
                        ],
                        'created_at' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss',
                        ],
                    ],
                ],
            ],
        ];

        $response = $client->indices()->create($params);
    }




    public function indexData()
    {
        $client = ClientBuilder::create()->setHosts(config('database.connections.elasticsearch.hosts'))->build();

        $articles = \App\Models\Test::all();

        foreach ($articles as $article) {
            $params = [
                'index' => 'my_index',
                'id' => $article->id,
                'body' => [
                    'title' => $article->title,
                    'body' => $article->body,
                    'created_at' => $article->created_at->format('Y-m-d H:i:s'),
                ],
            ];

            $response = $client->index($params);
        }
    }






    public function search()
    {
        $client = ClientBuilder::create()->setHosts(config('database.connections.elasticsearch.hosts'))->build();

        $params = [
            'index' => 'my_index',
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            ['match' => ['title' => 'laravel']],
                            ['match' => ['body' => 'laravel']],
                        ],
                    ],
                ],
            ],
        ];

        $response = $client->search($params);

        $hits = $response['hits']['hits'];

        foreach ($hits as $hit) {
            $article = Article::find($hit['_id']);

            // do something with article
        }
    }
}