<?php

require_once __DIR__ . '/../src/Song.php';
require_once __DIR__ . '/../src/Playlist.php';

class PlaylistController
{
    private Playlist $playlist;
    private string $dataFile;

    public function __construct()
    {
        $this->dataFile = __DIR__ . '/../data/playlist.json';
        $this->playlist = new Playlist("My Playlist", $this->dataFile);
        $this->playlist->loadFromFile();
    }

    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            switch ($action) {
                case 'add':
                    $this->addSong();
                    break;
                case 'delete':
                    $this->deleteSong();
                    break;
                case 'play':
                    $this->playSong();
                    break;
            }

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }

    private function addSong(): void
    {
        $title = trim($_POST['title'] ?? '');
        $artist = trim($_POST['artist'] ?? '');
        $duration = (int)($_POST['duration'] ?? 0);

        if ($title && $artist && $duration > 0) {
            $song = new Song($title, $artist, $duration);
            $this->playlist->addSong($song);
            $this->playlist->saveToFile();
        }
    }

    private function deleteSong(): void
    {
        $index = (int)($_POST['index'] ?? -1);
        
        if ($index >= 0) {
            $this->playlist->removeSong($index);
            $this->playlist->saveToFile();
        }
    }

    private function playSong(): void
    {
        $index = (int)($_POST['index'] ?? -1);
        $songs = $this->playlist->getSongs();
        
        if (isset($songs[$index])) {
            $song = $songs[$index];
            $_SESSION['now_playing'] = [
                'title' => $song->getTitle(),
                'artist' => $song->getArtist(),
                'duration' => $song->getDuration(),
                'formatted_duration' => $song->getFormattedDuration(),
                'started_at' => time()
            ];
        }
    }

    public function getSongs(): array
    {
        return $this->playlist->getSongs();
    }

    public function getPlaylistName(): string
    {
        return $this->playlist->getName();
    }

    public function getSongCount(): int
    {
        return count($this->playlist->getSongs());
    }

    public function getNowPlaying(): ?array
    {
        return $_SESSION['now_playing'] ?? null;
    }
}
