<?php

require_once __DIR__ . '/Song.php';

class Playlist
{
    private string $name;
    private array $songs;
    private string $dataFile;

    public function __construct(string $name, string $dataFile = '../data/playlist.json')
    {
        $this->name = $name;
        $this->songs = [];
        $this->dataFile = $dataFile;
    }

    public function addSong(Song $song): void
    {
        $this->songs[] = $song;
    }

    public function removeSong(int $index): bool
    {
        if (isset($this->songs[$index])) {
            array_splice($this->songs, $index, 1);
            return true;
        }
        return false;
    }

    public function getSongs(): array
    {
        return $this->songs;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function saveToFile(): bool
    {
        $songsData = [];
        foreach ($this->songs as $song) {
            $songsData[] = [
                'title' => $song->getTitle(),
                'artist' => $song->getArtist(),
                'duration' => $song->getDuration()
            ];
        }

        $data = [
            'name' => $this->name,
            'songs' => $songsData
        ];

        $dir = dirname($this->dataFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $json = json_encode($data, JSON_PRETTY_PRINT);
        return file_put_contents($this->dataFile, $json) !== false;
    }

    public function loadFromFile(): bool
    {
        if (!file_exists($this->dataFile)) {
            return false;
        }

        $json = file_get_contents($this->dataFile);
        $data = json_decode($json, true);

        if ($data === null) {
            return false;
        }

        $this->name = $data['name'];
        $this->songs = [];
        
        foreach ($data['songs'] as $songData) {
            $this->songs[] = new Song(
                $songData['title'],
                $songData['artist'],
                $songData['duration']
            );
        }

        return true;
    }
}
