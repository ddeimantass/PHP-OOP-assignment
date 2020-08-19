<?php
require __DIR__ . '/vendor/autoload.php';

use App\Client\Assignment;
use App\Http\Curl;
use App\Service\PostStatisticsService;

try {
    header('Content-type: application/json');
    $curl = new Curl();
    $assignmentClient = new Assignment($curl);
    $posts = $assignmentClient->getPosts();
    $postStatisticsService = new PostStatisticsService();

    print_r(\json_encode($postStatisticsService->getStatistics($posts)));
} catch (\Throwable $exception) {
    print_r(sprintf('{"error": "%s"}', $exception->getMessage()));
}
