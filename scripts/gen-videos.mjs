import { writeFile } from 'node:fs/promises';
import path from 'node:path';

async function fetchText(url, timeoutMs) {
  const controller = new AbortController();
  const timer = setTimeout(() => controller.abort(), timeoutMs);
  try {
    const res = await fetch(url, {
      signal: controller.signal,
      headers: {
        'user-agent': 'dobradinha-build'
      }
    });
    if (!res.ok) {
      throw new Error(`HTTP ${res.status} fetching ${url}`);
    }
    return await res.text();
  } finally {
    clearTimeout(timer);
  }
}

function parseBetween(str, start, end) {
  const s = str.indexOf(start);
  if (s === -1) return null;
  const from = s + start.length;
  const e = str.indexOf(end, from);
  if (e === -1) return null;
  return str.slice(from, e);
}

function parseYoutubeRss(xmlStr, limit) {
  // Minimal parsing without dependencies.
  // We extract: yt:videoId, title, published from each <entry>.
  const items = [];
  const entryStart = '<entry>';
  const entryEnd = '</entry>';

  let idx = 0;
  while (items.length < limit) {
    const s = xmlStr.indexOf(entryStart, idx);
    if (s === -1) break;
    const e = xmlStr.indexOf(entryEnd, s);
    if (e === -1) break;

    const entryXml = xmlStr.slice(s, e + entryEnd.length);
    idx = e + entryEnd.length;

    const videoId = parseBetween(entryXml, '<yt:videoId>', '</yt:videoId>');
    if (!videoId) continue;

    const title = parseBetween(entryXml, '<title>', '</title>') ?? 'Vídeo';
    const published = parseBetween(entryXml, '<published>', '</published>') ?? '';

    items.push({
      id: videoId.trim(),
      title: title.replace(/<!\[CDATA\[|\]\]>/g, '').trim(),
      published: published.trim(),
      thumb: `https://i.ytimg.com/vi/${videoId.trim()}/hqdefault.jpg`,
      url: `https://www.youtube.com/watch?v=${videoId.trim()}`
    });
  }

  return items;
}

export async function generateVideosJson({ siteDir, channelId }) {
  const outPath = path.join(siteDir, 'data', 'videos.json');

  const result = {
    generatedAt: new Date().toISOString(),
    channelId: channelId || '',
    items: []
  };

  // Per your request: keep channel id empty for now; skip fetch.
  if (!channelId) {
    await writeFile(outPath, JSON.stringify(result, null, 2) + '\n', 'utf8');
    return;
  }

  const feedUrl = `https://www.youtube.com/feeds/videos.xml?channel_id=${encodeURIComponent(channelId)}`;
  const xml = await fetchText(feedUrl, 6000);

  result.items = parseYoutubeRss(xml, 9);

  await writeFile(outPath, JSON.stringify(result, null, 2) + '\n', 'utf8');
}
