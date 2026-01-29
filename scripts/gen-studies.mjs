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
    {
      key: 'bible',
      title: 'Bíblia',
      sections: [
        { key: 'dt', title: 'Deuteronômio' },
        { key: 'sermons', title: 'Sermões' },
        { key: 'studies', title: 'Estudos' },
        { key: 'teology', title: 'Teologia' }
      ]
    },
    {
      key: 'books',
      title: 'Livros',
      sections: [
        { key: 'general', title: 'Geral' },
        { key: 'teology', title: 'Teologia' }
      ]
    },
    {
      key: 'family',
      title: 'Família',
      sections: [
        { key: 'children', title: 'Filhos' },
        { key: 'conflicts', title: 'Conflitos' },
        { key: 'life', title: 'Vida' },
        { key: 'marriage', title: 'Casamento' }
      ]
    }
  ];

  const result = {
    generatedAt: new Date().toISOString(),
    categories: []
  };

  for (const category of categoryDefs) {
    const categoryDir = path.join(studiesRoot, category.key);
    const sections = [];
    let totalCount = 0;

    for (const section of category.sections ?? []) {
      const sectionDir = path.join(categoryDir, section.key);

      let pdfPaths = [];
      try {
        const st = await stat(sectionDir);
        if (st.isDirectory()) {
          pdfPaths = await listPdfFilesRecursively(sectionDir);
        }
      } catch {
        // Section folder missing; keep empty.
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

      totalCount += files.length;
      sections.push({
        key: section.key,
        title: section.title,
        count: files.length,
        files
      });
    }

    result.categories.push({
      key: category.key,
      title: category.title,
      count: totalCount,
      sections
    });
  }

  const outPath = path.join(siteDir, 'data', 'studies.json');
  await writeFile(outPath, JSON.stringify(result, null, 2) + '\n', 'utf8');
}
