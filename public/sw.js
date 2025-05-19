const staticCache = 'static-v3';
const dynamicCache = 'dynamic-v1';

const assets = [
    // '/',
    '/fallback.html',
    '/favicon.ico',
    '/manifest.json',
    '/assets/fonts/nucleo-outline.woff2',
    '/assets/img/bg14.webp',
    // '/forgot-password',
    // '/confirm-password',
    // '/verify-email',
    '/css/auth/confirm-password.min.css',
    '/css/auth/forgot-password.min.css',
    '/css/auth/login.min.css',
    '/css/auth/reset-password.min.css',
    '/css/auth/verify-email.min.css',
    '/assets/js/core/bootstrap.min.js',
    '/assets/js/core/jquery.min.js',
    '/assets/js/core/popper.min.js',
    '/assets/js/plugins/bootstrap-datetimepicker.min.js',
    '/assets/js/plugins/bootstrap-notify.min.js',
    '/assets/js/plugins/bootstrap-selectpicker.min.js',
    '/assets/js/plugins/bootstrap-switch.min.js',
    '/assets/js/plugins/bootstrap-tagsinput.min.js',
    '/assets/js/plugins/chartjs.min.js',
    '/assets/js/plugins/fullcalendar.min.js',
    '/assets/js/plugins/jasny-bootstrap.min.js',
    '/assets/js/plugins/jquery.bootstrap-wizard.min.js',
    '/assets/js/plugins/jquery.dataTables.min.js',
    '/assets/js/plugins/jquery.validate.min.js',
    '/assets/js/plugins/jquery-jvectormap.min.js',
    '/assets/js/plugins/moment.min.js',
    '/assets/js/plugins/nouislider.min.js',
    '/assets/js/plugins/sweetalert2.min.js',
    '/assets/js/now-ui-dashboard.min.js',
];

// Cache size limit function
const limitCacheSize = (name, size) => {
    caches.open(name).then(cache => {
        cache.keys().then(keys => {
            if (keys.length > size) {
                cache.delete(keys[0]).then(() => limitCacheSize(name, size));
            }
        });
    });
};

// Install event
self.addEventListener('install', e => {
    // console.log('service worker installed');
    e.waitUntil(caches.open(staticCache).then(cache => {
        // console.log('caching shell assets');
        return cache.addAll(assets);
    }));
});

// Activate event
self.addEventListener('activate', e => {
    // console.log('service worker activated');
    e.waitUntil(caches.keys().then(keys => {
        // console.log(keys);

        // Removes cache from old service worker.
        return Promise.all(keys.filter(key => key !== staticCache && key !== dynamicCache).map(key => caches.delete(key)));
    }));
});

// Fetch events
self.addEventListener('fetch', e => {
    if (!e.request.url.includes('/logout')) {
        e.respondWith(caches.match(e.request).then(cacheRes => {
            // console.log(cacheRes);

            return cacheRes || fetch(e.request).then(fetchRes => {
                // console.log(fetchRes);

                // Filter unwanted pages like 404 pages from dynamic cache.
                if (!fetchRes || fetchRes.status !== 200 || fetchRes.type === 'opaqueredirect' || fetchRes.type !== 'basic') {
                    return fetchRes;
                }

                return fetchRes;

                // return caches.open(dynamicCache).then(cache => {
                //     cache.put(e.request.url, fetchRes.clone());
                //     // Check cached items size
                //     limitCacheSize(dynamicCache, 200);
                //     return fetchRes;
                // });
            });
        }).catch(err => {
            console.error(err);
            return caches.match('/fallback.html');
        }));
    } else {
        caches.keys().then(() => {
            caches.keys().then(keyList => {
                return Promise.all(keyList.map(key => {
                    if (key.includes('dynamic')) {
                        return caches.delete(key);
                    }
                }));
            });
        })
    }
});
