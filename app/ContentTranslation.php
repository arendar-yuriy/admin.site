<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ContentTranslation extends Model
{
    use Searchable;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'text',
        'metatags',
        'locale',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];

    public function searchableOptions()
    {
        return [
            // You may wish to change the default name of the column
            // that holds parsed documents
            'column' => 'searchable',
            // You may want to store the index outside of the Model table
            // In that case let the engine know by setting this parameter to true.
            'external' => true,
            // If you don't want scout to maintain the index for you
            // You can turn it off either for a Model or globally
            'maintain_index' => true,
            // Ranking groups that will be assigned to fields
            // when document is being parsed.
            // Available groups: A, B, C and D.
            'rank' => [
                'fields' => [
                    'name' => 'A',
                    'description' => 'C',
                    'text' => 'D',
                    'tags' => 'B'
                ],
                // Ranking weights for searches.
                // [D-weight, C-weight, B-weight, A-weight].
                // Default [0.1, 0.2, 0.4, 1.0].
                'weights' => [0.1, 0.2, 0.4, 1.0],
                // Ranking function [ts_rank | ts_rank_cd]. Default ts_rank.
                'function' => 'ts_rank',
                // Normalization index. Default 0.
                'normalization' => 32,
            ],
        ];


    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'text' => $this->text,
            'tags' => $this->content()
                ->first()
                ->tags
                ->pluck('text')
                ->implode(', ')
        ];
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
