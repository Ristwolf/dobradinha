import { readdir, stat, writeFile } from 'node:fs/promises';
import path from 'node:path';

function encodePathSegment(segment) {
  return encodeURIComponent(segment);
}

function toUrlPath(relativeFsPath) {
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
  return fileName.replace(/\.pdf$/i, '');
}

export async function generateStudiesJson({ siteDir }) {
  const studiesRoot = path.join(siteDir, 'studies');

  const categoryDefs = [
    { key: 'bible', title: 'Bíblia' },
    { key: 'books', title: 'Livros' },
    { key: 'family', title: 'Família' }
  ];

  const result = {
    generatedAt: new Date().toISOString(),
    categories: []
  };

  for (const category of categoryDefs) {
    const categoryDir = path.join(studiesRoot, category.key);

    let pdfPaths = [];
    try {
      const st = await stat(categoryDir);
      if (st.isDirectory()) {
        pdfPaths = await listPdfFilesRecursively(categoryDir);
      }
    } catch {
      // Category folder missing; keep empty.
    }

    pdfPaths.sort((a, b) => a.localeCompare(b, 'pt-BR'));

    const files = pdfPaths.map((absPath) => {
      const relFromSite = path.relative(siteDir, absPath);
      const url = toUrlPath(relFromSite);
      return {
        name: humanizeFilename(path.basename(absPath)),
        url
      };
    });

    result.categories.push({
      key: category.key,
      title: category.title,
      count: files.length,
      files
    });
  }

  const outPath = path.join(siteDir, 'data', 'studies.json');
  await writeFile(outPath, JSON.stringify(result, null, 2) + '\n', 'utf8');
}
