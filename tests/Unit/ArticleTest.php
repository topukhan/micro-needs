<?php

namespace Tests\Unit;

use App\Models\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_default_values_are_set_correctly()
    {
        $article = new Article;

        $this->assertFalse($article->is_published);          // boolean
        $this->assertEquals(0, $article->view_count);        // loose match
        $this->assertSame(0, $article->view_count);          // strict match
        $this->assertNull($article->published_at);           // null check
    }

    /** @test */
    public function it_allows_mass_assignment_for_fillable_attributes()
    {
        $data = [
            'title' => 'Test Article',
            'slug' => 'test-article',
            'excerpt' => 'Short description',
            'content' => 'Full article content',
            'featured_image' => 'image.jpg',
            'is_published' => true,
            'published_at' => now(),
            'view_count' => 10,
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'user_id' => 1,
            'category_id' => 2,
        ];

        $article = new Article;

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $article->$key);
        }
    }
}
