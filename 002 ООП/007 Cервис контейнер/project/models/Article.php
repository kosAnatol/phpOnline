<?php
namespace App\models;

class Article extends Model
{
    public ?int $id;
    public ?string $title;
    public ?string $content;
    public ?string $author;
    public ?string $images;


    protected static function getTableName(): string
    {
        return 'articles';
    }
}
