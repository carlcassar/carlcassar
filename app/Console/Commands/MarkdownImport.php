<?php

namespace App\Console\Commands;

use App\Models\Article;
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
use League\CommonMark\MarkdownConverter;
use Str;
use Symfony\Component\Finder\SplFileInfo;

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
        $this->getMarkdownFiles()->each(fn ($fileInfo) => $this->updateOrCreateArticle($fileInfo));

        $this->info('Markdown Imported!');
    }

    /**
     * @throws FileNotFoundException
     * @throws CommonMarkException
     */
    public function updateOrCreateArticle(SplFileInfo $fileInfo): void
    {
        $basename = $fileInfo->getBasename();

        $markdown = $this->convert(
            $this->filesystem->get(resource_path("markdown/$basename"))
        );

        $content = $markdown->get('content');
        $frontMatter = $markdown->get('frontMatter');

        $slug = $frontMatter->get('slug') ?? Str::slug($frontMatter->get('title'));

        dump($slug);

        Article::updateOrCreate([
            'slug' => $slug,
        ], [
            'title' => $frontMatter->get('title'),
            'slug' => $slug,
            'description' => $frontMatter->get('description'),
            'content' => $content,
            'image' => $frontMatter->get('image'),
            'tags' => collect($frontMatter->get('tags'))->join(', '),
            'published_at' => $this->date($frontMatter->get('published_at')),
            'deleted_at' => $this->date($frontMatter->get('deleted_at')),
            'created_at' => $this->date($frontMatter->get('created_at'), now()),
            'updated_at' => $this->date($frontMatter->get('updated_at'), now()),
        ]);
    }

    public function date($from, $fallback = null)
    {
        if (empty($from)) {
            return $fallback;
        }

        return Carbon::createFromFormat('d-m-Y H:i', $from);
    }

    /**
     * @throws CommonMarkException
     */
    public function convert(string $markdown): Collection
    {
        $config = [
            'heading_permalink' => [
                'symbol' => '#',
                'html_class' => 'no-underline mr-2 text-gray-500',
            ],
        ];

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new FrontMatterExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new HeadingPermalinkExtension());

        $converter = new MarkdownConverter($environment);

        $markdown = preg_replace_callback("/\[\[(.+)\]\]/", fn ($capture) => $capture = $this->linkify($capture[1]), $markdown);

        $markdown = $converter->convert($markdown);

        return collect([
            'content' => $markdown->getContent(),
            'frontMatter' => collect($markdown->getDocument()->data['front_matter']),
        ]);
    }

    private function getMarkdownFiles(): Collection
    {
        return collect($this->filesystem->files(resource_path('markdown')));
    }

    public function linkify($title)
    {
        $slug = Str::slug($title);

        return "[$title]($slug)";
    }
}
