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
        $sql = 'INSERT INTO videos (url, title, image_path) VALUES (?, ?, ?)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);
        $statement->bindValue(3, $video->getFilePath());

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
        $updateImageSql = '';
        if ($video->getFilePath() !== null) {
            $updateImageSql = ', image_path = :image_path';
        }
        $sql = "UPDATE videos SET
                  url = :url,
                  title = :title
                $updateImageSql
              WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':title', $video->title);
        $statement->bindValue(':id', $video->id, PDO::PARAM_INT);

        if ($video->getFilePath() !== null) {
            $statement->bindValue(':image_path', $video->getFilePath());
        }

        return $statement->execute();
    }

    public function removeImage(int $id):bool
    {
        $sql = "UPDATE videos SET image_path = :image_path WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(":image_path",null);
        $statement->bindValue(":id",$id,PDO::PARAM_INT);
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
        $video = new Video($videoData['url'], $videoData['title']);
        $video->setId($videoData['id']);

        if ($videoData['image_path'] !== null) {
            $video->setFilePath($videoData['image_path']);
        }

        return $video;
    }
}