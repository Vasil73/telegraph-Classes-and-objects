<?php

class TelegraphText {
    public $text;
    public $title;
    public $author;
    public $published;
    public $slug;

    public function __construct(string $author, string $slug)
    {
        $this->author = $author;
        $this->published = date("F j, Y, g:i a");
        $this->slug = $slug;
    }

    public function storeText(): void
    {
        $addTextArray = ['title' => $this, 'text' => $this->text,
            'author' => $this->author, 'published' => $this->published];
        file_put_contents($this->slug, serialize($addTextArray));
    }

    public function loadText()
    {
        if (file_exists($this->slug)) {
            $addTextArray = unserialize(file_get_contents($this->slug));
            $this->title = $addTextArray['title'];
            $this->text = $addTextArray['text'];
            $this->author = $addTextArray['author'];
            $this->published = $addTextArray['published'];
            return $this->text;
        }
        return false;

    }
    public function editText($text, $title){
        $this->text = $text;
        $this->title = $title;
    }
}

$class = new TelegraphText('Vasiliy', 'test_text_file');
$class -> storeText();
$class->loadText();
$class -> editText( 'Научиться работать с классами и объектами на практике.', 'Практическая работа' );
echo $class -> text . PHP_EOL;
