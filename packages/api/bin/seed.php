<?php

require dirname(__DIR__) . '/vendor/autoload.php';
$config = require dirname(__DIR__) . '/config/app.php';

$dbPath = $config['db']['path'];
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Test user (admin)
$id = bin2hex(random_bytes(16));
$pass = password_hash('password123', PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT OR IGNORE INTO users (id, name, email, pass_hash, role) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$id, 'Test User', 'test@example.com', $pass, 'admin']);

// Categories
$categories = [
    ['id' => bin2hex(random_bytes(16)), 'name' => 'Writing',        'slug' => 'writing'],
    ['id' => bin2hex(random_bytes(16)), 'name' => 'Image Generation','slug' => 'image-generation'],
    ['id' => bin2hex(random_bytes(16)), 'name' => 'Coding',         'slug' => 'coding'],
    ['id' => bin2hex(random_bytes(16)), 'name' => 'Audio',          'slug' => 'audio'],
    ['id' => bin2hex(random_bytes(16)), 'name' => 'Research',       'slug' => 'research'],
    ['id' => bin2hex(random_bytes(16)), 'name' => 'Productivity',   'slug' => 'productivity'],
];
$stmt = $pdo->prepare("INSERT OR IGNORE INTO categories (id, name, slug) VALUES (?, ?, ?)");
foreach ($categories as $cat) {
    $stmt->execute([$cat['id'], $cat['name'], $cat['slug']]);
}

// Providers
$providerId = bin2hex(random_bytes(16));
$stmt = $pdo->prepare("INSERT OR IGNORE INTO providers (id, name, slug) VALUES (?, ?, ?)");
$stmt->execute([$providerId, 'AI Ocean', 'ai-ocean']);

// Tools (matching the existing mock data)
$tools = [
    ['id' => '1', 'name' => 'WritePro',    'slug' => 'writepro',    'short_description' => 'AI powered writing assistant',          'pricing_model' => 'Freemium', 'category' => 'Writing'],
    ['id' => '2', 'name' => 'GenImg',      'slug' => 'genimg',      'short_description' => 'Generate images from text',             'pricing_model' => 'Paid',     'category' => 'Image Generation'],
    ['id' => '3', 'name' => 'CodeBuddy',   'slug' => 'codebuddy',   'short_description' => 'Your AI pair programmer',               'pricing_model' => 'Free',     'category' => 'Coding'],
    ['id' => '4', 'name' => 'MeetingBot',  'slug' => 'meetingbot',  'short_description' => 'Transcribe and summarize meetings',      'pricing_model' => 'Freemium', 'category' => 'Audio'],
    ['id' => '5', 'name' => 'DataSense',   'slug' => 'datasense',   'short_description' => 'Analyze datasets with NLP',             'pricing_model' => 'Paid',     'category' => 'Research'],
    ['id' => '6', 'name' => 'TaskMaster',  'slug' => 'taskmaster',  'short_description' => 'AI agents for your daily tasks',         'pricing_model' => 'Free',     'category' => 'Productivity'],
    ['id' => '7', 'name' => 'SEO AI',      'slug' => 'seo-ai',      'short_description' => 'Optimize content for search engines',   'pricing_model' => 'Freemium', 'category' => 'Writing'],
    ['id' => '8', 'name' => 'SnippetGen',  'slug' => 'snippetgen',  'short_description' => 'Generate code snippets instantly',       'pricing_model' => 'Free',     'category' => 'Coding'],
    ['id' => '9', 'name' => 'VoiceForge',  'slug' => 'voiceforge',  'short_description' => 'Natural text-to-speech generation',     'pricing_model' => 'Paid',     'category' => 'Audio'],
    ['id' => '10','name' => 'SlideGenius', 'slug' => 'slidegenius', 'short_description' => 'Create presentations from outlines',     'pricing_model' => 'Freemium', 'category' => 'Productivity'],
    ['id' => '11','name' => 'PixelMind',   'slug' => 'pixelmind',   'short_description' => 'AI-powered photo editing and enhancement','pricing_model' => 'Freemium', 'category' => 'Image Generation'],
    ['id' => '12','name' => 'ResearchPal', 'slug' => 'researchpal', 'short_description' => 'Summarize and analyze research papers',  'pricing_model' => 'Free',     'category' => 'Research'],
];
$stmtTool = $pdo->prepare("INSERT OR IGNORE INTO tools (id, name, slug, short_description, pricing_model, provider_id, status) VALUES (?, ?, ?, ?, ?, ?, 'active')");
$stmtCategory = $pdo->prepare("INSERT OR IGNORE INTO tool_category (tool_id, category_id) SELECT ?, id FROM categories WHERE slug = ?");
foreach ($tools as $tool) {
    $stmtTool->execute([$tool['id'], $tool['name'], $tool['slug'], $tool['short_description'], $tool['pricing_model'], $providerId]);
    $stmtCategory->execute([$tool['id'], $tool['category']]);
}

echo "Database seeded.\n";
echo "  - Test user: test@example.com / password123\n";
echo "  - " . count($tools) . " tools\n";
echo "  - " . count($categories) . " categories\n";
