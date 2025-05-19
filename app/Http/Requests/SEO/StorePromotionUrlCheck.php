<?php

namespace App\Http\Requests\SEO;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionUrlCheck extends FormRequest
{
    protected $errorBag = 'promotionUrlCheckError';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'moz_indexed_at' => 'required|date',
            'majestic_indexed_at' => 'required|date',
            'domain_authority' => 'required|integer',
            'citation_flow' => 'required|integer',
            'trust_flow' => 'required|integer',
            'domain_name' => 'required|string:500',
            'server_ip' => 'nullable|string:20',
            'http_status' => 'nullable|integer',
            'page_language' => 'nullable|string:2',
            'page_title' => 'nullable|string:80',
            'page_description' => 'nullable|string:200',
            'commentary' => 'nullable|string:500',
            'measured_at' => 'nullable|date',
            'latest_scan' => 'nullable|date',
            'latest_scan_update' => 'nullable|date',
            'follow_customer_backlinks' => 'nullable|integer',
            'no_follow_customer_backlinks' => 'nullable|integer',
            'follow_external_links' => 'nullable|integer',
            'no_follow_external_links' => 'nullable|integer',
            'follow_social_links' => 'nullable|integer',
            'no_follow_socials' => 'nullable|integer',
            'follow_internal_links' => 'nullable|integer',
            'no_follow_internal_links' => 'nullable|integer',
            'image_count' => 'nullable|integer',
            'observationCheckboxes.*' => 'nullable|string',
            'conclusionRadios' => 'required|integer',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'domain_authority' => __('check.domain_authority'),
            'citation_flow' => __('check.citation_flow'),
            'trust_flow' => __('check.trust_flow'),
            'domain_name' => __('check.domain_name'),
            'server_ip' => __('check.server_ip'),
            'http_status' => __('check.http_status'),
            'page_language' => __('check.page_language'),
            'page_title' => __('check.page_title'),
            'page_description' => __('check.page_description'),
            'commentary' => __('check.commentary'),
            'measured_at' => __('check.latest_scan'),
            'latest_scan' => __('check.latest_scan'),
            'latest_scan_update' => __('check.latest_update'),
            'follow_customer_backlinks' => __('check.follow_customer_backlinks'),
            'no_follow_customer_backlinks' => __('check.no_follow_customer_backlinks'),
            'follow_external_links' => __('check.follow_external_links'),
            'no_follow_external_links' => __('check.no_follow_external_links'),
            'follow_social_links' => __('check.follow_social_links'),
            'no_follow_socials' => __('check.no_follow_social_links'),
            'follow_internal_links' => __('check.follow_internal_links'),
            'no_follow_internal_links' => __('check.no_follow_internal_links'),
            'image_count' => __('check.image_count'),
            'observationCheckboxes.*' => __('check.observations'),
            'conclusionRadios' => __('check.conclusion'),
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'moz_indexed_at.required' => __('validation.required'),
            'majestic_indexed_at.required' => __('validation.required'),
            'domain_authority.required' => __('validation.required'),
            'citation_flow.required' => __('validation.required'),
            'trust_flow.required' => __('validation.required'),
            'domain_name.required' => __('validation.required'),
            'conclusionRadios.required' => __('validation.required'),

            'moz_indexed_at.date' => __('validation.date'),
            'majestic_indexed_at.date' => __('validation.date'),
            'domain_authority.integer' => __('validation.integer'),
            'citation_flow.integer' => __('validation.integer'),
            'trust_flow.integer' => __('validation.integer'),
            'domain_name.string' => __('validation.string'),
            'server_ip.string' => __('validation.string'),
            'http_status.integer' => __('validation.integer'),
            'page_language.string' => __('validation.string'),
            'page_title.string' => __('validation.string'),
            'page_description.string' => __('validation.string'),
            'commentary.string' => __('validation.string'),
            'measured_at.date' => __('validation.date'),
            'latest_scan.date' => __('validation.date'),
            'backlinks.integer' => __('validation.integer'),
            'no_follow_backlinks.integer' => __('validation.integer'),
            'external_links.integer' => __('validation.integer'),
            'no_follow_external_links.integer' => __('validation.integer'),
            'social_links.integer' => __('validation.integer'),
            'no_follow_socials.integer' => __('validation.integer'),
            'internal_links.integer' => __('validation.integer'),
            'no_follow_internal_links.integer' => __('validation.integer'),
            'observationCheckboxes.*.string' => __('validation.string'),
            'conclusionRadios.integer' => __('validation.integer'),

            'domain_name.max:500' => __('validation.max.string'),
            'server_ip.max:20' => __('validation.max.string'),
            'page_language.max:2' => __('validation.max.string'),
            'page_title.max:80' => __('validation.max.string'),
            'page_description.max:200' => __('validation.max.string'),
            'commentary.max:500' => __('validation.max.string'),
        ];
    }
}
