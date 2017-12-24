<?php namespace App\Traits;

use App\Models\Artist;

trait HandleArtists
{
    public function addArtists($artists)
    {
        foreach ($this->prepareArtists($artists) as $artist) {
            $this->addArtist($artist);
        }
        return true;
    }

    public function prepareArtists($artists)
    {
        if (is_null($artists)) {
            return [];
        }

        if (is_string($artists)) {
            $artists = [$artists];
        }

        return array_unique(array_filter($artists));
    }

    private function addArtist($name)
    {
        $artist = Artist::firstOrNew([
            'slug' => str_slug($name)
        ]);

        if (!$artist->exists) {
            $artist->name = trim($name);
            $artist->save();
        }

        if (!$this->artists()->get()->contains($artist->id)) {
            $this->artists()->attach($artist);
        }
    }
}
