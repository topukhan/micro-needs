<?php

namespace App\Http\Controllers\FormBuilder;

use App\Http\Controllers\Controller;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormBuilderController extends Controller
{
    public function index()
    {
        return view('formBuilder.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'field_type' => 'required|string',
            'field_name' => 'required|string|unique:form_fields,field_name',
            'field_label' => 'required|string',
            'css_framework' => 'required|string',
        ]);

        FormField::create($validated);

        return response()->json(['message' => 'Field saved successfully!'], 200);
    }
    
    public function preview(Request $request)
    {
        $fields = $request->fields; // Array of fields from AJAX
        $html = '';

        foreach ($fields as $field) {
            $html .= "<div class='mb-4'>";
            $html .= "<label class='block text-sm font-medium text-gray-700'>{$field['field_label']}</label>";
            $html .= "<input type='{$field['field_type']}' name='{$field['field_name']}' class='w-full border-gray-300 rounded mt-1'>";
            $html .= "</div>";
        }

        return response()->json(['html' => $html], 200);
    }


    public function renderForm()
    {
        $fields = FormField::all();
        return view('formBuilder.render', compact('fields'));
    }
}