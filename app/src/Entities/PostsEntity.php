<?php

namespace App\Entities;

use App\Entities\AbstractEntity;
use App\Database\DbConnexion;

class PostsEntity extends AbstractEntity
{
    private int $id;
    private string $title;
    private string $content;
    private int $user_id;
    private string $created_at;

    public function __construct()
    {
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $this->RemoveSpecialChar($title);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getPage(): int
    {
        return $_GET['page'] ?? 1;
    }

    public function getLimit(): int
    {
        return $_GET['limit'] ?? 10;
    }


    public function getPostsCount(): int
    {
        $sql = "SELECT COUNT(*) FROM posts";
        $stmt = getDbConnexion()->query($sql);
        $count = $stmt->fetchColumn();

        return $count;
    }

    public function getPagination(): array
    {
        $postsCount = $this->getPostsCount();
        $postsPerPage = $this->getLimit();
        $pagesCount = ceil($postsCount / $postsPerPage);

        return [
            'pagesCount' => $pagesCount,
            'currentPage' => $this->getPage(),
        ];
    }

    public function getPosts(): array
    {
        $db = (new DbConnexion())->execute();

        $currentPage = $this->getPage();
        $postsPerPage = $this->getLimit();
        $offset = ($currentPage - 1) * $postsPerPage;

        $sql = "SELECT posts.id, posts.title, posts.created_at, users.name, users.id as user_id
            FROM posts 
            INNER JOIN users ON posts.user_id = users.id
            ORDER BY posts.created_at DESC
            LIMIT 10
            OFFSET $offset;
            ";
        $stmt = $db->query($sql);
        $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $posts;
    }
}
