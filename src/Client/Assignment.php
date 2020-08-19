<?php

declare(strict_types=1);

namespace App\Client;

use App\DTO\PostModel;
use App\DTO\RegisterModel;
use App\Exception\BadPostDataException;
use App\Exception\BadRegisterDataException;
use App\Http\CurlInterface;

class Assignment
{
    const MAX_PAGES = 10;
    const URI = 'https://api.supermetrics.com/assignment/';

    private CurlInterface $curl;

    public function __construct(CurlInterface $curl)
    {
        $this->curl = $curl;
    }

    /**
     * @return array
     * @throws BadPostDataException
     * @throws BadRegisterDataException
     */
    public function getPosts(): array
    {
        $allPosts = [];
        for ($i = 1; $i <= self::MAX_PAGES; $i++) {
            $query = \http_build_query(['sl_token' => $this->getToken(), 'page' => $i]);
            $this->curl->setUrl(self::URI . 'posts?' . $query);
            $result = json_decode($this->curl->sendRequest(), true)['data'] ?? [];
            $posts = $result['posts'] ?? [];
            $this->appendPosts($allPosts, $posts);
        }

        return $allPosts;
    }

    /**
     * @return string
     * @throws BadRegisterDataException
     */
    private function getToken(): string
    {
        try {
            $fields = include('Config/fields.php');
            $this->curl->setUrl(self::URI . 'register');
            $result = json_decode($this->curl->sendRequest($fields, 'POST'), true)['data'] ?? [];
            $register = new RegisterModel(
                $result['sl_token'],
                $result['client_id'],
                $result['email'],
            );

            return $register->getToken();
        } catch (\Throwable $exception) {
            throw new BadRegisterDataException();
        }
    }

    /**
     * @param array $allPosts
     * @param array $posts
     * @throws BadPostDataException
     */
    private function appendPosts(array &$allPosts, array $posts)
    {
        try {
            foreach ($posts as $post) {
                $id = $post['id'];
                $allPosts[$id] = new PostModel(
                    $id,
                    $post['from_name'],
                    $post['from_id'],
                    $post['message'],
                    $post['type'],
                    new \DateTime($post['created_time']),
                );
            }
        } catch (\Throwable $exception) {
            throw new BadPostDataException();
        }
    }
}
