import { access, readdir, stat, writeFile } from 'node:fs/promises';
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

async function findCoverForPdf(pdfAbsPath) {
  const dir = path.dirname(pdfAbsPath);
  const base = path.basename(pdfAbsPath).replace(/\.pdf$/i, '');
  const exts = ['.jpg', '.jpeg', '.png', '.webp'];

  for (const ext of exts) {
    const candidate = path.join(dir, base + ext);
    try {
      await access(candidate);
      return candidate;
    } catch {
      // ignore
    }
  }

  return null;
}

export async function generateResumosJson({ siteDir }) {
  const resumosRoot = path.join(siteDir, 'resumos');

  const categoryDefs = [
    { key: 'bible', title: 'Bíblia' },
    { key: 'family', title: 'Família' },
    { key: 'history', title: 'História' },
    { key: 'ministry', title: 'Ministério' },
    { key: 'theology', title: 'Teologia' },
    { key: 'christian-life', title: 'Vida Cristã' }
  ];

  const result = {
    generatedAt: new Date().toISOString(),
    categories: []
  };

  for (const category of categoryDefs) {
    const categoryDir = path.join(resumosRoot, category.key);

    let pdfPaths = [];
    try {
      const st = await stat(categoryDir);
      if (st.isDirectory()) {
        // If there are nested folders later, this still works.
        pdfPaths = await listPdfFilesRecursively(categoryDir);
      }
    } catch {
      // Category folder missing; keep empty.
    }

    pdfPaths.sort((a, b) => a.localeCompare(b, 'pt-BR'));

    const files = [];
    for (const absPath of pdfPaths) {
      const relFromSite = path.relative(siteDir, absPath);
      const url = toUrlPath(relFromSite);
      const file = {
        name: humanizeFilename(path.basename(absPath)),
        url
      };

      const coverAbs = await findCoverForPdf(absPath);
      if (coverAbs) {
        const relCover = path.relative(siteDir, coverAbs);
        file.coverUrl = toUrlPath(relCover);
      }

      files.push(file);
    }

    result.categories.push({
      key: category.key,
      title: category.title,
      count: files.length,
      files
    });
  }

  const outPath = path.join(siteDir, 'data', 'resumos.json');
  await writeFile(outPath, JSON.stringify(result, null, 2) + '\n', 'utf8');
}

// Backwards-compatible alias (older code called this "abstracts").
export async function generateAbstractsJson({ siteDir }) {
  return generateResumosJson({ siteDir });
}
