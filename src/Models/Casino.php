<?php


namespace testtask\Models;

use testtask\Services\Db;
use testtask\Models\ActiveRecordEntity;
use testtask\Exceptions\InvalidArgumentException;
//use Exceptions\InvalidArgumentException;

class Casino extends ActiveRecordEntity
{
//    protected $casinoId;
    protected $casino;
    protected $bonus;
    protected  $rating, $upTo, $freeSpeen, $name;

    public function getAuthorId(): int
    {
//        return (int) $this->casinoId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->casino;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->bonus;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }else{
            try {
                throw new InvalidArgumentException('Undefined property ' . $this->property . ' referenced.');
            }catch (InvalidArgumentException $e){
                print_r($e->getMessage());
            }
        }
    }

    protected static function getTableName(): string
    {
        return 'casinos';
    }

    public function setName($casino): string
    {
        return $this->casino = $casino;
    }

    public function setText($txt): string
    {
        return $this->bonus = $txt;
    }

    public function setAuthor(User $author): void
    {
//        $this->casinoId = $author->getId();
    }

    public static function createFromArray(array $fields, User $author): Article
    {
        if (empty($fields['casino'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['bonus'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $article = new Article();

        $article->setAuthor($author);
        $article->setName($fields['casino']);
//        $test = $article->getParsedText($fields['bonus']);
        $article->setText($fields['bonus']);
//        $article
        $article->save();

        return $article;
    }

    public function updateFromArray(array $fields): Article
    {
        if (empty($fields['casino'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['bonus'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }
        $this->setName($fields['casino']);
        $this->setText($fields['bonus']);

        $this->save();

        return $this;
    }

    public function getParsedText(): string
    {
        $parser = new \Parsedown();

        return $parser->bonus($this->getText());
    }

}