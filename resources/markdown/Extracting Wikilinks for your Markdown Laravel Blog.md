---
title: Extracting Wikilinks for your Markdown Laravel Blog
slug: 
author: Carl Cassar
description: Wikilinks offer a convenient way to link to other pages in a blog, PKM or other wiki-like knowledge base. Let me show you how to make use of them in a Laravel Markdown-Powered Blog.
tags:
  - laravel
  - php
  - markdown
image: 
link: http://www.carlcassar.com/articles/extracting-wikilinks-for-your-markdown-laravel-blog#what-is-a-wikilink
published_at: 2023-08-22 23:24:42
created_at: 2023-07-16 21:00:00
updated_at: 2023-08-22 23:24:42
deleted_at:
---
I recently rebuilt this site so I could write my articles in Markdown. I'm used to writing in [Obsidian](https://obsidian.md) and have come to rely heavily on wikilinks. Laravel comes with [Markdown baked in](https://laravel.com/docs/10.x/helpers#method-fluent-str-markdown). Behind the scenes, it makes use of a package called [league/commonmark](https://commonmark.thephpleague.com). Commonmark offers a large list of extensions, but as we will see, none of them work to add Wikilinks functionality. 

TL;DR [[#Create your own wikilinks custom delimiter]]

## What is a Wikilink?

First things first, let's just do a quick recap. What exactly is a wikilink? Created and used by Wikipedia, [wikilinks](https://en.wikipedia.org/wiki/Help:Link) are a convenient way to link to internal pages. 

Say we have an internal article called "Tidying Tips", which it just so happens we do, then the conventional way to link to it would be by using an HTML [a](https://www.w3schools.com/tags/tag_a.asp) tag:

```html
<a href="https://www.carlcassar.com/articles/tidying-tips">
	Tidying Tips
</a>
```

In Markdown, this can be done by using markdown's link syntax:

```markdown
[Tidying Tips](https://www.carlcassar.com/articles/tidying-tips)
```

Now, its not unusual to link to several other internal pages within one article and links tend to be quite cumbersome to type out by hand. All the slashes and w's make it all too easy to make a mistake. Wikilinks were created as a wrapper to make it quick and convenient to link to other internal content. Using our earlier example, the syntax for a wikilink is as follows:

```markdown
[[Tidying Tips]]
```

It's as simple as that. You just wrap the title of the page you are linking to in double square brackets, `[[` and `]]`.

Wikilinks come with some additional features. We can change the "looks like" or alt text of the link by adding our preferred text after the title:

```
[[Tidying Tips|an short article on refactoring]]
```

Additionally, we can link to an id on the same page by using a `#` symbol.

```
[[#Some Heading On The Page]]
```

## League/Commonmark and Wikilinks

Commonmark is a fantastic package that handles a lot of work when it comes to using markdown in Laravel and PHP. Unfortunately, it does not support Wikilinks and will simply ignore any text wrapped in two square brackets.

Looking down [the list of extensions](https://commonmark.thephpleague.com/2.4/extensions/overview/), you will find one called [Mentions](https://commonmark.thephpleague.com/2.4/extensions/mentions/). The mentions extension allows one to parse mentions like `@carlcassar` and `#2343`. Unfortunately, it seems that although it will parse the prefixes `@`, `#` and almost anything else that I experimented with, including digits (`3...`) and random letters (`s...`), it will ignore square brackets, even when they are escaped correctly in a regular expression.

## Create your own wikilinks custom delimiter

Handily, not all is lost. Commonmark exposes its [delimiter processor](https://commonmark.thephpleague.com/2.4/customization/delimiter-processing/) API.

> Delimiter processors allow you to implement [delimiter runs](https://spec.commonmark.org/0.29/#delimiter-run) the same way the core library implements emphasis.

Using a delimiter processor, we can process text that is encapsulated in between a number of matching symbols, e.g. `*example*`, `{example}`, `{{example}}`.

First, we must add a delimiter processor to the Commonmark Enviroment:

```php
$environment->addDelimiterProcessor(new WikilinksDelimiterProcessor());
```

Next, we must create the `WikilinksDelimiterProcessor` which must implement the `DelimiterProcessorInterface`.

```php
class WikilinksDelimiterProcessor implements DelimiterProcessorInterface  
{
	//
}
```

In order to satisfy the contract of the Interface, we must implement 5 methods:

```php
public function getOpeningCharacter(): string  
{  
    return '[';  
}  
  
public function getClosingCharacter(): string  
{  
    return ']';  
}  
  
public function getMinLength(): int  
{  
    return 2;  
}  
  
public function getDelimiterUse(DelimiterInterface $opener, DelimiterInterface $closer): int  
{  
    return 2;  
}

public function process(AbstractStringContainer $opener, AbstractStringContainer $closer, int $delimiterUse): void  
{
	// What now?
}
```

In our case, the opening character is `[`, the closing character is `]` and we require two of each in order to process the literal string contained in our delimiter.

All that's left is to implement the process function which will tell commonmark what to do when it encounters our wikilink.

First, we need to get the literal string from the `AbstractStringContainer $opener`.

Now this is where it gets a little bit tricky. It seems that commonmark really doesn't like working with double square brackets. In this case, although it correctly identifies the string we are looking for, it fails to remove the second opening bracket and we are left with the literal string `[Tidying Tips`.

No problem, we can simply remove the bracket ourselves:

```php
private function getLiteralFrom(AbstractStringContainer $opener): Stringable  
{  
    $literal = $opener->next()->getLiteral();  
  
    // Commonmark does not work for double square brackets,  
    // so we will remove a leftover square bracket from    
    // the beginning of the opener literal string.    
    return Str::of($literal)->substr(1);  
}
```

At this point, we should keep in mind our eventual goal - to replace the text with a link. Commonmark has our back and provides a link node, which requires a `url` parameter and accepts an optional `label` and `title`. With this in mind, lets create a function to get those attributes from the literal:

```php
$attributes = $this->getAttributes(  
    $this->getLiteralFrom($opener)  
);
```

```php
private function getAttributes(Stringable $literal): Collection  
{  
    $explodedLiteral = $literal->explode('|');  
  
    $wikiTitle = $explodedLiteral[0];  
    $wikiLooksLike = count($explodedLiteral) > 1 ? $explodedLiteral[1] : null;  
  
    return collect([  
        'url' => $this->getUrlFor($wikiTitle),  
        'label' => $wikiLooksLike ?? $wikiTitle,  
        'title' => $wikiLooksLike ?? $wikiTitle,  
    ]);}
```

Finally, we need to cater for hash links as well as ordinary links:

```php
private function getUrlFor(string $wikiTitle)  
{  
    $slug = Str::of($wikiTitle)->slug();  
  
    return $this->isHashLink($wikiTitle) ? "#$slug" : $slug;  
}  
  
private function isHashLink(string $wikiTitle): bool  
{  
    return Str::of($wikiTitle)->substr(0, 1) == '#';  
}
```

Here is the final `WikilinksDelimiterProcessor` class:

```php
<?php  
  
namespace App\Console\Commands\Support;  
  
use Illuminate\Support\Collection;  
use Illuminate\Support\Stringable;  
use League\CommonMark\Delimiter\DelimiterInterface;  
use League\CommonMark\Delimiter\Processor\DelimiterProcessorInterface;  
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;  
use League\CommonMark\Node\Inline\AbstractStringContainer;  
use Str;  
  
class WikilinksDelimiterProcessor implements DelimiterProcessorInterface  
{  
    public function getOpeningCharacter(): string  
    {  
        return '[';  
    }  
    
    public function getClosingCharacter(): string  
    {  
        return ']';  
    }  
    
    public function getMinLength(): int  
    {  
        return 2;  
    }  
    
    public function getDelimiterUse(DelimiterInterface $opener, DelimiterInterface $closer): int  
    {  
        return 2;  
    }  
    
    public function process(AbstractStringContainer $opener, AbstractStringContainer $closer, int $delimiterUse): void  
    {  
        $attributes = $this->getAttributes(  
            $this->getLiteralFrom($opener)  
        );  
        
        $opener->next()->replaceWith(new Link(  
            $attributes->get('url'),  
            $attributes->get('label'),  
            $attributes->get('title')  
        ));    
	}
	  
    private function getLiteralFrom(AbstractStringContainer $opener): Stringable  
    {  
        $literal = $opener->next()->getLiteral();  
  
        // Commonmark does not work for double square brackets,  
		// so we will remove a leftover square bracket from   
		// the beginning of the opener literal string.    
	    return Str::of($literal)->substr(1);  
    }  
    
    private function getAttributes(Stringable $literal): Collection  
    {  
        $explodedLiteral = $literal->explode('|');  
  
        $wikiTitle = $explodedLiteral[0];  
        $wikiLooksLike = count($explodedLiteral) > 1 ? $explodedLiteral[1] : null;  
  
        return collect([  
            'url' => $this->getUrlFor($wikiTitle),  
            'label' => $wikiLooksLike ?? $wikiTitle,  
            'title' => $wikiLooksLike ?? $wikiTitle,  
        ]);    
	}  
        
    private function getUrlFor(string $wikiTitle)  
    {        
	    $slug = Str::of($wikiTitle)->slug();  
  
        return $this->isHashLink($wikiTitle) ? "#$slug" : $slug;  
    }  
    
    private function isHashLink(string $wikiTitle): bool  
    {  
        return Str::of($wikiTitle)->substr(0, 1) == '#';  
    }
}
```

## Test it out

All being well, I will include a few links using wikilinks syntax and you should be able to click through to each of them.

- [[Tidying Tips]] - `[[Tidying Tips]]`
- [[Tidying Tips|It Works!]] - `[[Tidying Tips|It Works!]]`
- [[#What is a Wikilink?|Wikilinks for the Win"]] - `[[#What is a Wikilink?|Wikilinks for the Win"]]`