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

async function copyResumosCategories({ resumosSrc, resumosDest }) {
  const categoryDirs = ['bible', 'family', 'history', 'ministry', 'theology', 'christian-life'];
  await ensureDir(resumosDest);

  // Copy per-category so we preserve the hand-authored page at site/resumos/index.html.
  for (const category of categoryDirs) {
    const srcDir = path.join(resumosSrc, category);
    const destDir = path.join(resumosDest, category);
    await rm(destDir, { recursive: true, force: true });
    await cp(srcDir, destDir, { recursive: true });
  }
}

async function copyStudiesCategories({ studiesSrc, studiesDest }) {
  const categoryDirs = ['bible', 'books', 'family'];
  await ensureDir(studiesDest);

  for (const category of categoryDirs) {
    const srcDir = path.join(studiesSrc, category);
    const destDir = path.join(studiesDest, category);
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

  const resumosSrc = path.join(repoRoot, 'resumos');
  const resumosDest = path.join(siteDir, 'resumos');
  await copyResumosCategories({ resumosSrc, resumosDest });

  const studiesSrc = path.join(repoRoot, 'studies');
  const studiesDest = path.join(siteDir, 'studies');
  await copyStudiesCategories({ studiesSrc, studiesDest });

  // Prevent Jekyll processing on GitHub Pages.
  await writeFile(path.join(siteDir, '.nojekyll'), '', 'utf8');

  // Generate JSON data used by the pages.
  const { generateResumosJson } = await import('./gen-resumos.mjs');
  await generateResumosJson({ siteDir });

  const { generateStudiesJson } = await import('./gen-studies.mjs');
  await generateStudiesJson({ siteDir });

  const { generateVideosJson } = await import('./gen-videos.mjs');
  await generateVideosJson({ siteDir, channelId: process.env.YOUTUBE_CHANNEL_ID ?? '' });
}

await main();
