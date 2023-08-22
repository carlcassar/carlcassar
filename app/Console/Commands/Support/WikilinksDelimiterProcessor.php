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
