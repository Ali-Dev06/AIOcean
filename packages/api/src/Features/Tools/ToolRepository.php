<?php

declare(strict_types=1);

namespace App\Features\Tools;

/**
 * Tool repository — data access layer.
 *
 * Currently uses in-memory seed data. When the DB is ready,
 * swap to raw SQL queries against the TOOL + CATEGORY tables.
 */
final class ToolRepository implements ToolRepositoryInterface
{
    /** @var Tool[] */
    private array $tools;

    public function __construct()
    {
        // Seed data matching the MOCK_TOOLS from the React app.
        // Replace with SQL queries when the database is connected.
        $this->tools = [
            new Tool('1',  'WritePro',    '✍️', 'AI powered writing assistant',             'Writing',          'Freemium', 'Web',               15400, 4.8, 'Writing emails'),
            new Tool('2',  'GenImg',      '🎨', 'Generate images from text',                'Image Generation', 'Paid',     'API',               4200,  4.5, 'Blog assets'),
            new Tool('3',  'CodeBuddy',   '💻', 'Your AI pair programmer',                  'Coding',           'Free',     'Browser Extension', 89000, 4.9, 'Refactoring'),
            new Tool('4',  'MeetingBot',  '🎙️', 'Transcribe and summarize meetings',        'Audio',            'Freemium', 'Web',               12000, 4.2, 'Meeting notes'),
            new Tool('5',  'DataSense',   '📊', 'Analyze datasets with NLP',                'Research',         'Paid',     'Web',               3100,  4.7, 'Data analysis'),
            new Tool('6',  'TaskMaster',  '✅', 'AI agents for your daily tasks',            'Productivity',     'Free',     'Mobile',            22000, 4.6, 'Task automation'),
            new Tool('7',  'SEO AI',      '🚀', 'Optimize content for search engines',      'Writing',          'Freemium', 'Web',               8500,  4.3, 'SEO optimization'),
            new Tool('8',  'SnippetGen',  '🧩', 'Generate code snippets instantly',          'Coding',           'Free',     'Browser Extension', 45000, 4.8, 'Boilerplate code'),
            new Tool('9',  'VoiceForge',  '🗣️', 'Natural text-to-speech generation',        'Audio',            'Paid',     'API',               6700,  4.4, 'Voiceovers'),
            new Tool('10', 'SlideGenius', '📝', 'Create presentations from outlines',        'Productivity',     'Freemium', 'Web',               18200, 4.6, 'Pitch decks'),
            new Tool('11', 'PixelMind',   '🖼️', 'AI-powered photo editing and enhancement', 'Image Generation', 'Freemium', 'Web',               31000, 4.7, 'Product photos'),
            new Tool('12', 'ResearchPal', '🔬', 'Summarize and analyze research papers',     'Research',         'Free',     'Browser Extension', 9400,  4.5, 'Literature review'),
        ];
    }

    /**
     * @return Tool[]
     */
    public function findAll(): array
    {
        return $this->tools;
    }

    public function findById(string $id): ?Tool
    {
        foreach ($this->tools as $tool) {
            if ($tool->id === $id) {
                return $tool;
            }
        }
        return null;
    }

    /**
     * @return Tool[]
     */
    public function findByCategory(string $category): array
    {
        return array_values(array_filter(
            $this->tools,
            fn(Tool $t) => strcasecmp($t->category, $category) === 0
        ));
    }

    /**
     * @return Tool[]
     */
    public function search(string $query): array
    {
        $q = strtolower($query);
        return array_values(array_filter(
            $this->tools,
            fn(Tool $t) => str_contains(strtolower($t->name), $q)
                        || str_contains(strtolower($t->tagline), $q)
                        || str_contains(strtolower($t->primaryUseCase), $q)
        ));
    }

    /**
     * Get all distinct categories.
     *
     * @return string[]
     */
    public function categories(): array
    {
        $cats = array_unique(array_map(fn(Tool $t) => $t->category, $this->tools));
        sort($cats);
        return array_values($cats);
    }
}
