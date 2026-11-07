@extends('dashboard.layouts.master')
@section('title', 'Admin Dashboard - Settings - SEO')
@section('content')

<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">SEO Settings</h1>
                <span class="mb-0 text-muted fs-12">Edit Global Metadata</span>
            </div>
        </div>
        <!-- End::page-header -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Edit SEO Settings</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4">
                                <!-- Basic Meta Tags Section -->
                                <div class="col-xl-12">
                                    <h5 class="mb-3">Basic Meta Tags</h5>
                                </div>

                                <div class="col-xl-12">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $seo->meta_title) }}" placeholder="Enter meta title">
                                </div>

                                <div class="col-xl-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" rows="3" placeholder="Enter meta description">{{ old('meta_description', $seo->meta_description) }}</textarea>
                                </div>

                                <div class="col-xl-12">
                                    <label class="form-label">Meta Keywords</label>
                                    <textarea class="form-control" name="meta_keywords" rows="2" placeholder="Enter keywords (comma separated)">{{ old('meta_keywords', $seo->meta_keywords) }}</textarea>
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Author (Default Author Name)</label>
                                    <input type="text" class="form-control" name="author" value="{{ old('author', $seo->author) }}" placeholder="John Doe">
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Canonical URL</label>
                                    <input type="url" class="form-control" name="canonical_url" value="{{ old('canonical_url', $seo->canonical_url) }}" placeholder="https://example.com">
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Robots Meta Tag</label>
                                    <select class="form-control" name="robots">
                                        <option value="index,follow" {{ old('robots', $seo->robots ?? 'index,follow') == 'index,follow' ? 'selected' : '' }}>Index, Follow (Default)</option>
                                        <option value="noindex,follow" {{ old('robots', $seo->robots) == 'noindex,follow' ? 'selected' : '' }}>No Index, Follow</option>
                                        <option value="index,nofollow" {{ old('robots', $seo->robots) == 'index,nofollow' ? 'selected' : '' }}>Index, No Follow</option>
                                        <option value="noindex,nofollow" {{ old('robots', $seo->robots) == 'noindex,nofollow' ? 'selected' : '' }}>No Index, No Follow</option>
                                    </select>
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Favicon</label>
                                    <input type="file" class="form-control" name="favicon" accept=".ico,.png,.jpg,.jpeg">
                                    @if($seo->favicon)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $seo->favicon) }}" width="32" alt="Current Favicon" class="rounded">
                                    </div>
                                    @endif
                                </div>

                                <div class="col-xl-12">
                                    <hr>
                                </div>

                                <!-- Open Graph Section -->
                                <div class="col-xl-12">
                                    <h5 class="mb-3">Open Graph (Facebook/Social Media)</h5>
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Open Graph Type</label>
                                    <select class="form-control" name="og_type">
                                        <option value="website" {{ old('og_type', $seo->og_type ?? 'website') == 'website' ? 'selected' : '' }}>Website (Default)</option>
                                        <option value="article" {{ old('og_type', $seo->og_type) == 'article' ? 'selected' : '' }}>Article</option>
                                        <option value="product" {{ old('og_type', $seo->og_type) == 'product' ? 'selected' : '' }}>Product</option>
                                        <option value="profile" {{ old('og_type', $seo->og_type) == 'profile' ? 'selected' : '' }}>Profile</option>
                                    </select>
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Site Name (og:site_name)</label>
                                    <input type="text" class="form-control" name="og_site_name" value="{{ old('og_site_name', $seo->og_site_name) }}" placeholder="Your Site Name">
                                </div>

                                <div class="col-xl-12">
                                    <label class="form-label">Open Graph Image (Social Media Share Image)</label>
                                    <input type="file" class="form-control" name="og_image" accept="image/*">
                                    @if($seo->og_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $seo->og_image) }}" width="200" alt="Current OG Image" class="rounded">
                                    </div>
                                    @endif
                                </div>

                                <div class="col-xl-12">
                                    <hr>
                                </div>

                                <!-- Twitter Card Section -->
                                <div class="col-xl-12">
                                    <h5 class="mb-3">Twitter Card Settings</h5>
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Twitter Handle (@username)</label>
                                    <input type="text" class="form-control" name="twitter_handle" value="{{ old('twitter_handle', $seo->twitter_handle) }}" placeholder="@yourhandle">
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Twitter Card Type</label>
                                    <select class="form-control" name="twitter_card_type">
                                        <option value="summary_large_image" {{ old('twitter_card_type', $seo->twitter_card_type ?? 'summary_large_image') == 'summary_large_image' ? 'selected' : '' }}>Summary Large Image (Default)</option>
                                        <option value="summary" {{ old('twitter_card_type', $seo->twitter_card_type) == 'summary' ? 'selected' : '' }}>Summary</option>
                                        <option value="app" {{ old('twitter_card_type', $seo->twitter_card_type) == 'app' ? 'selected' : '' }}>App</option>
                                        <option value="player" {{ old('twitter_card_type', $seo->twitter_card_type) == 'player' ? 'selected' : '' }}>Player</option>
                                    </select>
                                </div>

                                <div class="col-xl-12">
                                    <hr>
                                </div>

                                <!-- Scripts Section -->
                                <div class="col-xl-12">
                                    <h5 class="mb-3">Custom Scripts</h5>
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Header Script Code (e.g., Google Analytics)</label>
                                    <textarea class="form-control" name="header_code" rows="5" placeholder="<script>...</script>">{{ old('header_code', $seo->header_code) }}</textarea>
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label">Footer Script Code</label>
                                    <textarea class="form-control" name="footer_code" rows="5" placeholder="<script>...</script>">{{ old('footer_code', $seo->footer_code) }}</textarea>
                                </div>

                                <div class="col-xl-12 mt-4">
                                    <button type="submit" class="btn btn-primary">Update Settings</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection