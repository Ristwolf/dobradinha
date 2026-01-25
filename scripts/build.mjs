import { mkdir, rm, cp, writeFile } from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const repoRoot = path.resolve(__dirname, '..');
const siteDir = path.join(repoRoot, 'site');
const outDataDir = path.join(siteDir, 'data');

async function ensureDir(dirPath) {
  await mkdir(dirPath, { recursive: true });
}

async function copyDir(src, dest) {
  await rm(dest, { recursive: true, force: true });
  await ensureDir(path.dirname(dest));
  await cp(src, dest, { recursive: true });
}

async function copyAbstractsCategories({ abstractsSrc, abstractsDest }) {
  const categoryDirs = ['bible', 'family', 'history', 'ministry', 'theology', 'christian-life'];
  await ensureDir(abstractsDest);

  // Copy per-category so we preserve the hand-authored page at site/abstracts/index.html.
  for (const category of categoryDirs) {
    const srcDir = path.join(abstractsSrc, category);
    const destDir = path.join(abstractsDest, category);
    await rm(destDir, { recursive: true, force: true });
    await cp(srcDir, destDir, { recursive: true });
  }
}

async function main() {
  await ensureDir(siteDir);
  await ensureDir(outDataDir);

  // Copy static assets into the publish folder.
  // Source folders live at repo root; publish folder is site/.
  const imgSrc = path.join(repoRoot, 'img');
  const imgDest = path.join(siteDir, 'img');
  await copyDir(imgSrc, imgDest);

  const abstractsSrc = path.join(repoRoot, 'abstracts');
  const abstractsDest = path.join(siteDir, 'abstracts');
  await copyAbstractsCategories({ abstractsSrc, abstractsDest });

  // Prevent Jekyll processing on GitHub Pages.
  await writeFile(path.join(siteDir, '.nojekyll'), '', 'utf8');

  // Generate JSON data used by the pages.
  const { generateAbstractsJson } = await import('./gen-abstracts.mjs');
  await generateAbstractsJson({ siteDir });

  const { generateVideosJson } = await import('./gen-videos.mjs');
  await generateVideosJson({ siteDir, channelId: process.env.YOUTUBE_CHANNEL_ID ?? '' });
}

await main();
