<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class CoverFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function handle()
    {
        if($this->input('q')) {
            // Overwrite the query builder with Scout's builder
            $this->query = forward_static_call([$this->getModel(), 'search'], $this->input('q'));
            // Apply all the filterable input to Scout's query builder
            $this->filterInput();

            return $this->query;
        }

        return parent::handle();
    }

    public function tags($tags)
    {
        return $this->withAnyTags($tags);
    }
}
