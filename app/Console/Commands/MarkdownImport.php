<?php

namespace App\Console\Commands;

use App\Console\Commands\Support\WikilinksDelimiterProcessor;
use App\Models\Article;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Exception\CommonMarkException;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Output\RenderedContentInterface;
use Str;
use Symfony\Component\DomCrawler\Crawler;

class MarkdownImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:markdown-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import markdown files into the database.';

    /**
     * A list of fields that must be present in the front-matter.
     */
    protected array $properties = [
        'title',
        'slug',
        'author',
        'description',
        'tags',
        'image',
        'link',
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     *  A list of fields that must not be null.
     */
    protected array $required = [
        'title',
        'author',
        'description',
        'tags',
        'created_at',
        'updated_at',
        'link',
    ];

    private Filesystem $filesystem;

    public function __construct()
    {
        parent::__construct();

        $this->filesystem = new Filesystem();
    }

    /**
     * Execute the console command.
     *
     * @throws CommonMarkException|FileNotFoundException
     */
    public function handle(): void
    {
        $this->getMarkdownFiles()->each(fn ($fileInfo) => $this->updateOrCreateArticle($fileInfo->getBasename()));

        $this->info('Markdown Imported!');
    }

    /**
     * @throws FileNotFoundException
     * @throws CommonMarkException
     * @throws Exception
     */
    public function updateOrCreateArticle(string $file): void
    {
        $markdown = $this->getMarkdown($file);

        $this->validate(
            /** @var Collection $frontMatter */
            $frontMatter = $markdown->get('frontMatter')
        );

        $this->info('Processing '.$frontMatter->get('title'));

        Article::updateOrCreate([
            'slug' => $frontMatter->get('slug') ?? Str::slug($frontMatter->get('title')),
        ], [
            'title' => $frontMatter->get('title'),
            'slug' => $frontMatter->get('slug') ?? Str::slug($frontMatter->get('title')),
            'description' => $frontMatter->get('description'),
            'table_of_contents' => $markdown->get('tableOfContents'),
            'content' => $markdown->get('content'),
            'image' => $frontMatter->get('image'),
            'tags' => collect($frontMatter->get('tags')),
            'published_at' => $this->dateTime($frontMatter->get('published_at')),
            'deleted_at' => $this->dateTime($frontMatter->get('deleted_at')),
            'created_at' => $this->dateTime($frontMatter->get('created_at')),
            'updated_at' => $this->dateTime($frontMatter->get('updated_at')),
        ]);
    }

    public function dateTime($from): ?Carbon
    {
        if (! $from) {
            return null;
        }

        return Carbon::parse($from);
    }

    /**
     * @throws CommonMarkException
     */
    public function convert(string $markdown): Collection
    {
        $environment = new Environment([
            'heading_permalink' => [
                'symbol' => '#',
                'html_class' => 'no-underline mr-2 text-gray-500',
                'aria_hidden' => false,
                'id_prefix' => '',
                'fragment_prefix' => '',
            ],
        ]);

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new FrontMatterExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new HeadingPermalinkExtension());
        $environment->addExtension(new TableOfContentsExtension());

        $environment->addDelimiterProcessor(new WikilinksDelimiterProcessor());

        $converter = new MarkdownConverter($environment);

        $markdown = $converter->convert($markdown);

        [$table_of_contents, $content] = $this->extractTableOfContents($markdown);

        return collect([
            'content' => $content,
            'tableOfContents' => $table_of_contents,
            'frontMatter' => collect($markdown->getDocument()->data['front_matter']),
        ]);
    }

    private function getMarkdownFiles(): Collection
    {
        return collect($this->filesystem->files(resource_path('markdown')));
    }

    /**
     * @throws Exception
     */
    private function validate($frontMatter): void
    {
        $this->ensureFrontMatterContainsAllProperties($frontMatter);
        $this->ensureFrontMatterHasTheCorrectNumberOfProperties($frontMatter);
        $this->ensureFrontMatterPropertiesAreInTheCorrectOrder($frontMatter);
        $this->ensureRequiredPropertiesAreFilled($frontMatter);
    }

    /**
     * @throws CommonMarkException
     * @throws FileNotFoundException
     */
    private function getMarkdown(string $name): Collection
    {
        return $this->convert(
            $this->filesystem->get(resource_path("markdown/$name"))
        );
    }

    private function extractTableOfContents(RenderedContentInterface $markdown): array
    {
        $table_of_contents = '';

        $crawler = new Crawler($markdown->getContent());
        $ulNodes = $crawler->filter('ul.table-of-contents');

        foreach ($ulNodes as $ulNode) {
            $capturedContent = '';
            foreach ($ulNode->childNodes as $childNode) {
                $capturedContent .= $ulNode->ownerDocument->saveHTML($childNode);
            }
            $table_of_contents = $capturedContent;
            $ulNode->parentNode->removeChild($ulNode);
        }

        $content = $crawler->html();

        return [$table_of_contents, $content];
    }

    /**
     * @throws Exception
     */
    private function ensureFrontMatterContainsAllProperties($frontMatter): void
    {
        collect($this->properties)->each(function ($property) use ($frontMatter) {
            if (! $frontMatter->has($property)) {
                throw new Exception(
                    "Article '{$frontMatter->get('title')}' is missing required front-matter property '{$property}'."
                );
            }
        });
    }

    /**
     * @throws Exception
     */
    private function ensureFrontMatterHasTheCorrectNumberOfProperties($frontMatter): void
    {
        if ($frontMatter->keys()->count() > count($this->properties)) {
            throw new Exception("'{$frontMatter->get('title')}' has more properties than it should.");
        }
    }

    /**
     * @throws Exception
     */
    private function ensureFrontMatterPropertiesAreInTheCorrectOrder($frontMatter): void
    {
        if ($frontMatter->keys()->toArray() !== $this->properties) {
            throw new Exception("'{$frontMatter->get('title')}' properties are out of order.");
        }
    }

    /**
     * @throws Exception
     */
    private function ensureRequiredPropertiesAreFilled($frontMatter): void
    {
        collect($this->required)->each(function ($required) use ($frontMatter) {
            if (! $frontMatter->get($required) || $frontMatter->get($required) == '') {
                throw new Exception(
                    "Article '{$frontMatter->get('title')}' front-matter property '{$required}' cannot be null."
                );
            }
        });
    }
}
