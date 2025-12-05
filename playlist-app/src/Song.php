<?php

class Song
{
    private string $title;
    private string $artist;
    private int $duration;

    public function __construct(string $title, string $artist, int $duration)
    {
        $this->title = $title;
        $this->artist = $artist;
        $this->duration = $duration;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getArtist(): string
    {
        return $this->artist;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getFormattedDuration(): string
    {
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;
        return sprintf("%02d:%02d", $minutes, $seconds);
    }

    public function display(): string
    {
        return sprintf(
            "%s - %s [%s]",
            $this->title,
            $this->artist,
            $this->getFormattedDuration()
        );
    }
}
