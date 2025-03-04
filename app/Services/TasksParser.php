<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class TasksParser
{
    private $tasks =[];

    public function __construct(private PageLoader $pageLoader)
    {
    }

    public function refresh(int $year, int $week)
    {
        if (!isset($this->tasks[$year][$week])) {
            $content = $this->pageLoader->getPage($year, $week);
            $crawler = new Crawler($content);
            $result['date'] = $crawler->filter('h1')->first()->text();
            $result['tasks'] = [];
            $crawler->filter('h3')->each(function (Crawler $el) use(&$result) {
                $matches = [];

                if (preg_match('/\d{1,2}\.\s/', $el->text(), $matches)) {
                    $speech = $el->nextAll()->count() > 0 && str_contains($el->nextAll()->eq(0)?->text(), 'Промова.');
                        $result['tasks'][] =  $el->text() . ( $speech ? ' '. 'Промова.': '');
                } ;
            });
            $this->tasks[$year][$week] = $result;
        }
    }

    public function getDate(int $year, int $week)
    {
        $this->refresh($year, $week);
        return $this->tasks[$year][$week]['date'];


    }
    public function getTasks(int $year, int $week)
    {
        $this->refresh($year, $week);
        return $this->tasks[$year][$week]['tasks'];
    }
}
