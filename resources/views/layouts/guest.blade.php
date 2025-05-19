<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head
    :title="config('app.name', 'Laravel')"
    :description="'SEO Center guarantees quality for websites of customers to get higher on google search results. If you are looking for a way to guarantee the quality of your website with blogs and backlinks to get higher into the google search results, this tool is the thing for you.'"
    :css="$css ?? ''"
    :font-awesome="$fontAwesome ?? false"
></x-head>
<style>
    /* cyrillic-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }
    /* latin */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }
    /* cyrillic-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }
    /* latin */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }
    /* cyrillic-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }
    /* latin */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Nucleo Outline;
        src: url({{asset('assets/fonts/nucleo-outline.eot')}});
        src: url({{asset('assets/fonts/nucleo-outline.eot')}}) format("embedded-opentype"), url({{asset('assets/fonts/nucleo-outline.woff2')}}) format("woff2"), url({{asset('assets/fonts/nucleo-outline.woff')}}) format("woff"), url({{asset('assets/fonts/nucleo-outline.ttf')}}) format("truetype");
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }
</style>
<body class="{{ $class ?? '' }}">
<a class="skip-main" href="#main">Skip to main content</a>
<div class="wrapper wrapper-full-page">
    <x-guest-navbar :name-page="$namePage" :active-page="$activePage"></x-guest-navbar>
    <main id="main" tabindex="-1" class="full-page register-page section-image" filter-color="black" style="background-image: url('{{ $backgroundImage }}')">
        {{$slot}}
        <x-footer></x-footer>
    </main>
</div>
</body>
{{-- Service worker --}}
<x-service-worker></x-service-worker>
</html>
