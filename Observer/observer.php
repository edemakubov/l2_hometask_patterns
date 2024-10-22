<?php

interface ObserverInterface
{
    public function update(string $updatedText);
}

class WordCounterObserver implements ObserverInterface
{
    public function update($updatedText)
    {
        echo 'words counter: ' . str_word_count($updatedText) . PHP_EOL;
    }
}

class NumberCounterObserver implements ObserverInterface
{
    public function update(string $updatedText)
    {
        $words = explode(" ", $updatedText);
        $numbers = array_filter($words, function ($word) {
            return is_numeric($word);
        });
        echo 'total numbers count: ' . count($numbers) . PHP_EOL;
    }
}

class LongestWordKeeperObserver implements ObserverInterface
{
    public function update(string $updatedText)
    {
        $words = explode(" ", $updatedText);

        usort($words, function ($a, $b) {
            return strlen($b) - strlen($a);
        });

        $longest = $words[0];

        echo 'Longest word: ' . $longest . PHP_EOL;
    }
}

class ReverseWordsObserver implements ObserverInterface
{
    public function update(string $updatedText)
    {
        $words = explode(" ", $updatedText);
        $reversed = array_map(function ($word) {
            return strrev($word);
        }, $words);

        echo 'reverse text: ' . implode(" ", $reversed) . PHP_EOL;
    }
}


class SomeTextClass
{
    private array $observers = [];
    public string $baseText = "";

    public function changeBaseText(string $text)
    {
        $this->baseText = $text;
        $this->notify();
    }

    public function attach(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    private function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->baseText);
        }
    }
}

$observers = [
    new WordCounterObserver(),
    new NumberCounterObserver(),
    new LongestWordKeeperObserver(),
    new ReverseWordsObserver(),
];

$observableClass = new SomeTextClass();

foreach ($observers as $observer) {
    $observableClass->attach($observer);
}

$observableClass->changeBaseText("Some 1 string to test 3 the Observers 333");








