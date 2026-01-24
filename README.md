# dobradinha

Static site (plain HTML + small JS) designed for GitHub Pages.

## Local build

Requirements: Node.js 18+.

On Ubuntu/Debian you can install Node.js and npm with:

- `sudo apt update && sudo apt install -y nodejs npm`

- Install: `npm install`
- Build publish folder: `npm run build`

The build:
- copies `img/` -> `site/img/`
- copies `abstracts/` -> `site/abstracts/`
- generates `site/data/abstracts.json`
- generates `site/data/videos.json`

## YouTube channel id (later)

By default, videos are generated empty.

To enable fetching:

- set env var `YOUTUBE_CHANNEL_ID` and rebuild
  - example: `YOUTUBE_CHANNEL_ID=UCxxxx npm run build`

## Deploy

GitHub Actions workflow deploys `site/` to GitHub Pages.

In GitHub:
- Settings -> Pages -> Source: GitHub Actions
