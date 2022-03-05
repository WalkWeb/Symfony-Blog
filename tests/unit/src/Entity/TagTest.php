<?php

declare(strict_types=1);

namespace App\Tests\unit\src\Entity;

use App\Entity\Tag;
use App\Tests\unit\AbstractUnitTest;
use Exception;

class TagTest extends AbstractUnitTest
{
    /**
     * @throws Exception
     */
    public function testTagCreate(): void
    {
        $name = 'Tag name';

        $tag = new Tag($name);

        $this->em->persist($tag);
        $this->em->flush();

        $tags = $this->getTags();

        self::assertCount(1, $tags);

        foreach ($tags as $tag) {
            self::assertFalse($tag->isApproved());
            self::assertEquals($name, $tag->getName());
            self::assertCount(0, $tag->getPosts());
        }
    }

    public function testTagApproved(): void
    {
        $tag = new Tag('Tag name');

        self::assertFalse($tag->isApproved());

        $tag->approved();

        self::assertTrue($tag->isApproved());
    }

    /**
     * @return Tag[]
     */
    private function getTags(): array
    {
        return $this->em->getRepository(Tag::class)->findAll() ?: [];
    }
}
