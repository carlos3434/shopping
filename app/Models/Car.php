<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Elasticquent\ElasticquentTrait;

class Car extends Model
{
    use Uuid, HasFactory, ElasticquentTrait;

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'category_id',
        'original_price',
        'actual_price',
        'image',
        'quantity',
        'status',
        'model',
        'registration',
        'size'
    ];

    protected $indexSettings = [
        'analysis' => [
            'char_filter' => [
                'replace' => [
                    'type' => 'mapping',
                    'mappings' => [
                        '&=> and '
                    ],
                ],
            ],
            'filter' => [
                'word_delimiter' => [
                    'type' => 'word_delimiter',
                    'split_on_numerics' => false,
                    'split_on_case_change' => true,
                    'generate_word_parts' => true,
                    'generate_number_parts' => true,
                    'catenate_all' => true,
                    'preserve_original' => true,
                    'catenate_numbers' => true,
                ]
            ],
            'analyzer' => [
                'default' => [
                    'type' => 'custom',
                    'char_filter' => [
                        'html_strip',
                        'replace',
                    ],
                    'tokenizer' => 'whitespace',
                    'filter' => [
                        'lowercase',
                        'word_delimiter',
                    ],
                ],
            ],
        ],
    ];
    /*
    protected $mappingProperties = array(
        'title' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'description' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'model' => [
          'type' => 'string',
          "analyzer" => "stop",
          "stopwords" => [","]
        ],
        'registration' => [
          'type' => 'string',
          "analyzer" => "stop",
          "stopwords" => [","]
        ]
    );*/
    
    function getIndexName()
    {
        return 'cars';
    }

    function getTypeName()
    {
        return 'cars';
    }
}
