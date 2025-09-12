<?php

namespace App\Post\Response;

class PostGetQuantityPostsResponse
{
    public function __construct(
        public string $username,
        public int $count,
    ) {
    }
}
