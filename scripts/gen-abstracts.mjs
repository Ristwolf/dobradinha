import { readdir, stat, writeFile } from 'node:fs/promises';
import path from 'node:path';

function encodePathSegment(segment) {
  // Encode each segment so accents/spaces are safe in URLs.
  return encodeURIComponent(segment);
}

function toUrlPath(relativeFsPath) {
  // Convert OS path to URL path and encode each segment.
  const parts = relativeFsPath.split(path.sep).filter(Boolean);
  return parts.map(encodePathSegment).join('/');
}

async function listPdfFilesRecursively(dirPath) {
  const entries = await readdir(dirPath, { withFileTypes: true });
  const files = [];

  for (const entry of entries) {
    const fullPath = path.join(dirPath, entry.name);
    if (entry.isDirectory()) {
      files.push(...(await listPdfFilesRecursively(fullPath)));
      continue;
    }

    if (entry.isFile() && entry.name.toLowerCase().endsWith('.pdf')) {
      files.push(fullPath);
    }
  }

  return files;
}

function humanizeFilename(fileName) {
  // Keep it simple and predictable: use basename without extension.
  const base = fileName.replace(/\.pdf$/i, '');
  return base;
}

export async function generateAbstractsJson({ siteDir }) {
  const abstractsRoot = path.join(siteDir, 'abstracts');

  const categories = await readdir(abstractsRoot, { withFileTypes: true });
  const categoryKeys = categories
    .filter((d) => d.isDirectory())
    .map((d) => d.name)
    .sort((a, b) => a.localeCompare(b, 'pt-BR'));

  const result = {
    generatedAt: new Date().toISOString(),
    categories: []
  };

  for (const key of categoryKeys) {
    const categoryDir = path.join(abstractsRoot, key);

    // If there are nested folders later, this still works.
    const pdfPaths = await listPdfFilesRecursively(categoryDir);
    pdfPaths.sort((a, b) => a.localeCompare(b, 'pt-BR'));

    const files = pdfPaths.map((absPath) => {
      const relFromSite = path.relative(siteDir, absPath);
      const url = './' + toUrlPath(relFromSite);
      return {
        name: humanizeFilename(path.basename(absPath)),
        url
      };
    });

    result.categories.push({
      key,
      title: key,
      count: files.length,
      files
    });
  }

  const outPath = path.join(siteDir, 'data', 'abstracts.json');
  await writeFile(outPath, JSON.stringify(result, null, 2) + '\n', 'utf8');
}
