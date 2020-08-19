<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\PostModel;

class PostStatisticsService
{
    /**
     * @param PostModel[] $posts
     * @return array
     */
    public function getStatistics(array $posts): array
    {
        return [
            'Average character length of posts per month' => $this->getAvgPostCharCountPerMonth($posts),
            'Longest post by character length per month' => $this->getLongestPostPerMonth($posts),
            'Total posts split by week number' => $this->getPostStatsPerWeek($posts),
            'Average number of posts per user per month' => $this->getPostStatsPerUserPerMonth($posts),
        ];
    }

    /**
     * @param PostModel[] $posts
     * @return array
     */
    public function getAvgPostCharCountPerMonth(array $posts): array
    {
        $postStats = $avg = [];
        foreach ($posts as $post) {
            $month = $post->getCreatedTime()->format('Y-m');
            if (!isset($postStats[$month])) {
                $postStats[$month] = [
                    'charCount' => 0,
                    'total' => 0,
                ];
                $avg[$month] = 0;
            }

            $count = $postStats[$month]['charCount'] += \strlen($post->getMessage());
            $total = ++$postStats[$month]['total'];
            $avg[$month] = $count / $total;
        }

        return $avg;
    }

    /**
     * @param PostModel[] $posts
     * @return array
     */
    public function getLongestPostPerMonth(array $posts): array
    {
        $longest = [];
        foreach ($posts as $post) {
            $month = $post->getCreatedTime()->format('Y-m');
            $message = $post->getMessage();
            if (!isset($postStats[$month])) {
                $longest[$month] = $message;
            } elseif (\strlen($message) > \strlen($longest[$month])) {
                $longest[$month] = $post;
            }
        }

        return $longest;
    }

    /**
     * @param PostModel[] $posts
     * @return array
     */
    public function getPostStatsPerWeek(array $posts): array
    {
        $postStats = [];
        foreach ($posts as $post) {
            $week = $post->getCreatedTime()->format('Y-W');
            if (!isset($postStats[$week])) {
                $postStats[$week] = 0;
            }

            ++$postStats[$week];
        }

        return $postStats;
    }

    /**
     * @param PostModel[] $posts
     * @return array
     */
    public function getPostStatsPerUserPerMonth(array $posts): array
    {
        $postStats = [];
        foreach ($posts as $post) {
            $userId = $post->getFromId();
            $month = $post->getCreatedTime()->format('Y-m');
            if (!isset($postStats[$userId][$month])) {
                $postStats[$userId][$month] = 0;
            }

            ++$postStats[$userId][$month];
        }

        return $postStats;
    }
}