import { jsxDEV, Fragment } from "react/jsx-dev-runtime";
import { renderToString } from "react-dom/server";
import { Helmet, HelmetProvider } from "react-helmet-async";
const FALLBACK_DESCRIPTION = "Baca berita terkini dari Pondok Pesantren Jauharul Falah Al-Islamy.";
const stripHtml = (value) => value ? value.replace(/<[^>]*>/g, " ") : "";
const normalizeSpaces = (value) => value.replace(/\s+/g, " ").trim();
const truncate = (value, maxLength) => value.length > maxLength ? `${value.slice(0, maxLength).trim()}...` : value;
const buildDescription = (rawContent) => {
  const plain = normalizeSpaces(stripHtml(rawContent));
  return plain ? truncate(plain, 160) : FALLBACK_DESCRIPTION;
};
const toAbsoluteUrl = (thumbnail, origin) => {
  if (!thumbnail) {
    return `${origin}/favicon/android-chrome-512x512.png`;
  }
  if (/^https?:\/\//i.test(thumbnail)) {
    return thumbnail;
  }
  const sanitized = thumbnail.replace(/^\/+/, "");
  return `${origin}/storage/${sanitized}`;
};
function BeritaOgDocument({ berita, articleUrl, origin }) {
  const description = buildDescription(berita.konten);
  const title = `${berita.judul} | Pondok Pesantren Jauharul Falah Al-Islamy`;
  const imageUrl = toAbsoluteUrl(berita.thumbnail, origin);
  const imageAlt = berita.judul;
  return /* @__PURE__ */ jsxDEV(Fragment, { children: [
    /* @__PURE__ */ jsxDEV(Helmet, { prioritizeSeoTags: true, children: [
      /* @__PURE__ */ jsxDEV("title", { children: title }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 58,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { name: "description", content: description }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 59,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:title", content: title }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 61,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:description", content: description }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 62,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:type", content: "article" }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 63,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:url", content: articleUrl }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 64,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:image", content: imageUrl }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 65,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:image:alt", content: imageAlt }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 66,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:image:width", content: "1200" }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 67,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:image:height", content: "630" }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 68,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:site_name", content: "Pondok Pesantren Jauharul Falah Al-Islamy" }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 69,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { property: "og:locale", content: "id_ID" }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 70,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { name: "twitter:card", content: "summary_large_image" }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 72,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { name: "twitter:title", content: title }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 73,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { name: "twitter:description", content: description }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 74,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { name: "twitter:image", content: imageUrl }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 75,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("meta", { name: "twitter:image:alt", content: imageAlt }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 76,
        columnNumber: 9
      }, this),
      /* @__PURE__ */ jsxDEV("link", { rel: "canonical", href: articleUrl }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
        lineNumber: 78,
        columnNumber: 9
      }, this)
    ] }, void 0, true, {
      fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
      lineNumber: 57,
      columnNumber: 7
    }, this),
    /* @__PURE__ */ jsxDEV("div", { id: "ssr-meta-placeholder" }, void 0, false, {
      fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
      lineNumber: 81,
      columnNumber: 7
    }, this)
  ] }, void 0, true, {
    fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/ssr/BeritaOgDocument.tsx",
    lineNumber: 56,
    columnNumber: 5
  }, this);
}
const BERITA_ROUTE_REGEX = /^\/berita\/([^/?#]+)/;
const fallbackResult = {
  html: "",
  head: ""
};
async function render(url, options = {}) {
  var _a, _b, _c;
  const match = BERITA_ROUTE_REGEX.exec(url);
  if (!match) {
    return fallbackResult;
  }
  const slug = decodeURIComponent(match[1]);
  const origin = options.origin ?? "";
  const apiBaseUrl = (options.apiBaseUrl ?? origin).replace(/\/$/, "");
  const publicBaseUrl = (options.publicBaseUrl ?? origin).replace(/\/$/, "");
  const articleUrl = `${publicBaseUrl}${url}`;
  try {
    const response = await fetch(`${apiBaseUrl}/api/berita/${slug}`, {
      headers: { Accept: "application/json" }
    });
    if (!response.ok) {
      return { ...fallbackResult, status: response.status };
    }
    const payload = await response.json();
    if (!(payload == null ? void 0 : payload.success) || !(payload == null ? void 0 : payload.data)) {
      return { ...fallbackResult, status: 404 };
    }
    const berita = payload.data;
    const helmetContext = {};
    renderToString(
      /* @__PURE__ */ jsxDEV(HelmetProvider, { context: helmetContext, children: /* @__PURE__ */ jsxDEV(BeritaOgDocument, { berita, articleUrl, origin: publicBaseUrl }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/entry-server.tsx",
        lineNumber: 57,
        columnNumber: 9
      }, this) }, void 0, false, {
        fileName: "/Users/kodrat/Public/Source Code/AlFalah/frontend/src/entry-server.tsx",
        lineNumber: 56,
        columnNumber: 7
      }, this)
    );
    const helmet = helmetContext.helmet;
    if (!helmet) {
      return { ...fallbackResult };
    }
    const headChunks = [(_a = helmet.title) == null ? void 0 : _a.toString(), (_b = helmet.meta) == null ? void 0 : _b.toString(), (_c = helmet.link) == null ? void 0 : _c.toString()].filter(Boolean).join("\n");
    return {
      html: "",
      head: headChunks,
      status: 200
    };
  } catch (error) {
    console.error("SSR render error", error);
    return { ...fallbackResult, status: 500 };
  }
}
export {
  render
};
