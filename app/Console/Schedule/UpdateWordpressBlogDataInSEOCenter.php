<?php

namespace App\Console\Schedule;

use gmu\wpBlogBuilder\Models\WordpressBlog;
use gmu\wpBlogBuilder\Models\WordpressWebsite;
use gmu\wpBlogBuilder\Models\WordpressWebsiteFormat;
use gmu\wpBlogBuilder\Models\WordpressWebsiteStatus;
use gmu\wpBlogBuilder\Models\WpBlogBuilder;

class UpdateWordpressBlogDataInSEOCenter
{
    /**
     * Update all wordpress blog data in SEO Center from wordpress websites.
     *
     * @return void
     */
    public function __invoke()
    {
        // Get all wordpress websites registered in SEO Center.
        $seoCenterWebsites = WordpressWebsite::getAllWordpressUrls();

        // Get all wordpress blogs registered in SEO Center.
        $seoCenterBlogs = WordpressBlog::getAllWordpressBlogs();

        // Go through every registered wordpress website.
        foreach ($seoCenterWebsites as $seoCenterWebsite) {
            // Get every blog from the wordpress website.
            $wordpressBlogs = WpBlogBuilder::getPosts($seoCenterWebsite->url);

            // Get website url.
            $websiteUrl = parse_url($seoCenterWebsite->url)['host'];

            // Get all id's from each blog.
            $wordpressBlogIds = collect($wordpressBlogs)->pluck('id')->toArray();

            $seoCenterIds = $seoCenterBlogs->pluck('wordpress_website_blog_id')->toArray();

            // Go through every registered blog in SEO Center.
            foreach ($seoCenterBlogs as $seoCenterBlog) {
                // Check if blog from SEO Center exists in wordpress.
                $blogSeoCenterInWordpress = collect($wordpressBlogs)->whereIn('id', $seoCenterBlog->wordpress_website_blog_id);

                // Check if wordpress has yoast plug enabled.
                $yoastPluginStatus = WpBlogBuilder::checkYoastEnabled(
                    $seoCenterWebsite->url,
                    $seoCenterWebsite->token
                );

                if (count($blogSeoCenterInWordpress) > 0) {
                    if ($yoastPluginStatus === 'active') {
                        foreach ($blogSeoCenterInWordpress as $blog) {
                            $featuredImage = $blog['_embedded']['wp:featuredmedia']['0']['source_url'] ?? null;

                            WordpressBlog::find($seoCenterBlog->id)->update([
                                'wordpress_website_status_id' => WordpressWebsiteStatus::getIdByName($blog['status'])[0]->id,
                                'wordpress_website_format_id' => WordpressWebsiteFormat::getIdByName($blog['format'])[0]->id,
                                'wordpress_blog_category_id' => $blog['categories'][0],
                                'wordpress_website_blog_id' => $blog['id'],
                                'title' => $blog['title']['rendered'],
                                'seo_title' => $blog['yoast_head_json']['title'] ?? $seoCenterBlog->seo_title,
                                'description' => $blog['yoast_head_json']['description'] ?? $seoCenterBlog->description,
                                'image' => $featuredImage ?? $seoCenterBlog->image,
                                'content' => $blog['content']['rendered'],
                                'publication_date' => date('Y-m-d\TH:i:s', strtotime($blog['date'])),
                            ]);
                        }
                    } else {
                        foreach ($blogSeoCenterInWordpress as $blog) {
                            $featuredImage = $blog['_embedded']['wp:featuredmedia']['0']['source_url'] ?? null;

                            WordpressBlog::find($seoCenterBlog->id)->update([
                                'wordpress_website_status_id' => WordpressWebsiteStatus::getIdByName($blog['status'])[0]->id,
                                'wordpress_website_format_id' => WordpressWebsiteFormat::getIdByName($blog['format'])[0]->id,
                                'wordpress_blog_category_id' => $blog['categories'][0],
                                'wordpress_website_blog_id' => $blog['id'],
                                'title' => $blog['title']['rendered'],
                                'image' => $featuredImage ?? $seoCenterBlog->image,
                                'content' => $blog['content']['rendered'],
                                'publication_date' => date('Y-m-d\TH:i:s', strtotime($blog['date'])),
                            ]);
                        }
                    }
                }

                // Check if blog from wordpress does not exist in SEO Center.
                $newWordpressBlog = collect($wordpressBlogs)->whereNotIn('id', $seoCenterIds);

                if (count($newWordpressBlog) > 0) {
                    foreach ($newWordpressBlog as $blog) {
                        $featuredImage = $blog['_embedded']['wp:featuredmedia']['0']['source_url'] ?? '';

                        WordpressBlog::create([
                            'wordpress_website_id' => WordpressWebsite::getWebsiteByWordpressUrl($websiteUrl)[0]->id,
                            'wordpress_website_status_id' => WordpressWebsiteStatus::getIdByName($blog['status'])[0]->id,
                            'wordpress_website_format_id' => WordpressWebsiteFormat::getIdByName($blog['format'])[0]->id,
                            'wordpress_blog_category_id' => $blog['categories'][0],
                            'wordpress_website_blog_id' => $blog['id'],
                            'title' => $blog['title']['rendered'],
                            'seo_title' => $blog['yoast_head_json']['title'] ?? '',
                            'description' => $blog['yoast_head_json']['description'] ?? '',
                            'image' => $featuredImage,
                            'content' => $blog['content']['rendered'],
                            'publication_date' => date('Y-m-d\TH:i:s', strtotime($blog['date'])),
                        ]);
                    }
                }

                // Check if blog from SEO Center does not exist in wordpress.
                $oldSeoCenterBlog = collect($seoCenterBlogs)->whereNotIn('wordpress_website_blog_id', $wordpressBlogIds);

                if (count($oldSeoCenterBlog) > 0) {
                    foreach ($oldSeoCenterBlog as $blog) {
                        WordpressBlog::find($blog->id)->delete();
                    }
                }
            }
        }
    }
}
