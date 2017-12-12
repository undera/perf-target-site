# Demo Site for Perf Testing Tools

## Features

### Headers
+ cookies flags for web UI - top right corner access

Response times
Error rates


## Deploying
```bash
# git clone <repo>
composer.phar update
ln -s vendor/.htaccess
ln -s vendor/index.php
```

## Ideas

- coordinated omission demo - http://bravenewgeek.com/everything-you-know-about-latency-is-wrong/
- Scripting and recording aspect
  - Flash
  - One-page app
  - Static HTML
  - Dynamic HTML

- kinds of pages
    - light
    - heavy
    - different distributions
    - cacheable
        - cache warmup
- kinds of bottlenecks
    - out of resource
        - CPU and HDD, Net (active)
        - memory and file descriptors, ports ( passive)
    - lack of tuning
      - threads & workers
    - thirdparty API calls
    - locking
