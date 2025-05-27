<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Handle authorization in controller/policy
    }

    public function rules(): array
    {
        $routeName = $this->route()->getName();
        $articleId = $this->route('article'); // Assuming route model binding

        return match(true) {
            // Force Delete Validation
            $routeName === 'articles.forceDelete' => [
                'confirmation' => ['required', 'string', 'confirmed:delete']
            ],
            
            // Store (Create) Validation
            $this->isMethod('post') => $this->storeRules(),
            
            // Update Validation
            $this->isMethod('put') => $this->updateRules($articleId),
            
            default => []
        };
    }

    protected function storeRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:articles,title'],
            'slug' => ['required', 'string', 'max:255', 'unique:articles,slug'],
            'content' => ['required', 'string', 'min:100'],
            'excerpt' => ['nullable', 'string', 'max:300'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'is_published' => ['sometimes', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:160']
        ];
    }

    protected function updateRules($articleId): array
    {
        return [
            'title' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('articles', 'title')->ignore($articleId)
            ],
            'slug' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('articles', 'slug')->ignore($articleId)
            ],
            'content' => ['sometimes', 'string', 'min:100'],
            // Include other fields same as storeRules() with 'sometimes'
        ];
    }

    public function messages(): array
    {
        return [
            'confirmation.confirmed' => 'Confirmation text must match "delete"',
            'slug.unique' => 'This URL slug is already in use',
            'content.min' => 'Content must be at least 100 characters'
        ];
    }
}
