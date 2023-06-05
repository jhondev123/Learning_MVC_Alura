<?php

namespace Jhonattan\MVC\Repository;

use Jhonattan\MVC\Entity\Video;
use PDO;

class VideoRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addVideo(Video $video):bool
    {
        $sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);
        $result = $statement->execute();
        $id = $this->pdo->lastInsertId();
        $video->setId(intval($id));
        return $result;

    }

    public function removeVideo(int $id):bool
    {
        $sql = "DELETE FROM videos WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(":id",$id,PDO::PARAM_INT);
        return $statement->execute();
    }

    public function updateVideo(Video $video):bool
    {
        $sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':title', $video->title);
        $statement->bindValue(':id', $video->id, PDO::PARAM_INT);
        return $statement->execute();
    }

    /** @return Video[] */

    public function allVideos():array
    {
        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);

        return  array_map(function(array $videoData){
            $video = new Video($videoData['url'],$videoData['title']);
            $video->setId($videoData['id']);
            return $video;
        },
            $videoList
        );

    }

    public function all()
    {
        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateVideo(...),
            $videoList
        );
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $statement->bindValue(1,$id,PDO::PARAM_INT);
        $statement->execute();
        return $this->hydrateVideo($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateVideo(array $videoData):Video
    {
        $video = new Video($videoData['url'],$videoData['title']);
        $video->setId($videoData['id']);
        return $video;
    }
}