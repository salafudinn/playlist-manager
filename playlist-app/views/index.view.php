<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .content {
            padding: 2rem;
        }

        .now-playing {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .now-playing-icon {
            font-size: 2rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .now-playing-info {
            flex: 1;
        }

        .now-playing-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .now-playing-artist {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .now-playing-duration {
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .form-section h2 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 2fr 2fr 1fr auto;
            gap: 1rem;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #10b981;
            color: white;
        }

        .btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-play {
            background: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            margin-right: 0.5rem;
        }

        .btn-play:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .playlist-section h2 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
        }

        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #555;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr {
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .song-title {
            font-weight: 500;
            color: #333;
        }

        .song-artist {
            color: #666;
        }

        .song-duration {
            color: #888;
            font-family: 'Courier New', monospace;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #999;
        }

        .empty-state svg {
            width: 64px;
            height: 64px;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .container {
                margin: 0;
                border-radius: 0;
            }

            body {
                padding: 0;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Playlist Manager</h1>
            <p><?= htmlspecialchars($controller->getPlaylistName()) ?> • <?= $controller->getSongCount() ?> songs</p>
        </div>

        <div class="content">
            <?php $nowPlaying = $controller->getNowPlaying(); ?>
            <?php if ($nowPlaying): ?>
                <div class="now-playing">
                    <div class="now-playing-icon">▶</div>
                    <div class="now-playing-info">
                        <div class="now-playing-title"><?= htmlspecialchars($nowPlaying['title']) ?></div>
                        <div class="now-playing-artist"><?= htmlspecialchars($nowPlaying['artist']) ?></div>
                        <div class="now-playing-duration"><?= $nowPlaying['formatted_duration'] ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-section">
                <h2>Add New Song</h2>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="add">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="title">Song Title</label>
                            <input type="text" id="title" name="title" required placeholder="Enter song title">
                        </div>
                        <div class="form-group">
                            <label for="artist">Artist</label>
                            <input type="text" id="artist" name="artist" required placeholder="Enter artist name">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration (sec)</label>
                            <input type="number" id="duration" name="duration" required min="1" placeholder="180">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Song</button>
                    </div>
                </form>
            </div>

            <div class="playlist-section">
                <h2>Your Playlist</h2>
                <?php if ($controller->getSongCount() > 0): ?>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Artist</th>
                                    <th>Duration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($controller->getSongs() as $index => $song): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td class="song-title"><?= htmlspecialchars($song->getTitle()) ?></td>
                                        <td class="song-artist"><?= htmlspecialchars($song->getArtist()) ?></td>
                                        <td class="song-duration"><?= $song->getFormattedDuration() ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <form method="POST" action="" style="display: inline;">
                                                    <input type="hidden" name="action" value="play">
                                                    <input type="hidden" name="index" value="<?= $index ?>">
                                                    <button type="submit" class="btn btn-play">Play</button>
                                                </form>
                                                <form method="POST" action="" style="display: inline;">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="index" value="<?= $index ?>">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                        <p>No songs in your playlist yet. Add one above!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
