<?php

declare(strict_types=1);

namespace App\Tests\unit\src\Entity;

use App\Entity\Post;
use App\Tests\unit\AbstractUnitTest;
use Exception;

class PostTest extends AbstractUnitTest
{
    /**
     * Тест на создание поста
     *
     * @throws Exception
     */
    public function testPostCreate(): void
    {
        $title = 'Post title';
        $text = 'post text';

        $post = new Post($title, $text);

        $this->em->persist($post);
        $this->em->flush();

        $posts = $this->getPosts();

        self::assertCount(1, $posts);

        foreach ($posts as $post) {
            self::assertEquals($title, $post->getTitle());
            self::assertEquals($text, $post->getText());
            self::assertCount(0, $post->getTags());
        }
    }

    /**
     * @return Post[]
     */
    private function getPosts(): array
    {
        return $this->em->getRepository(Post::class)->findAll() ?: [];
    }
}
