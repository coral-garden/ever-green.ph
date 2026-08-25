# Siargao local SEO and keyword-gap research

**Date:** 2026-08-25  
**Site:** [ever-green.ph](https://www.ever-green.ph/)  
**Scope:** Evergreen Solar, Evergreen Frame Construction, and Evergreen Hardware Supply, with emphasis on Siargao commercial and local intent.

## Executive summary

Evergreen has a better SEO foundation than its sampled search visibility suggests. The deployed pages return `200`, allow crawling, declare canonical URLs, include Siargao in most page titles, and are listed in a sitemap. The site also contains unusually strong first-party proof: named Siargao projects, locations, equipment specifications, testimonials, current hardware prices, and an estimator.

The main gap is that this proof is not organized into enough search-focused, independently indexable destinations. Several high-intent concepts exist only in meta descriptions, card copy, or one large projects index. The generic H1s on construction, hardware, services, projects, estimate, and contact pages do not clearly restate the service and place. The hardware title omits Siargao. There are no individual project/case-study URLs. Organization/LocalBusiness JSON-LD appears only on the group homepage; that is not inherently wrong, but the divisions' local identities and offerings are only lightly described in the graph.

The highest-priority off-site issue is a **citation/NAP correction gap**. Siargao Finder currently describes “Evergreen Solar Siargao” as serving Dapa, shows no phone, and points to Facebook, while the pre-change site presented Burgos as an office, showed two phone numbers, and used `ever-green.ph`. The owner has now confirmed the correct operating model below. Every controlled and third-party profile should be aligned with it. Google says complete, accurate business information supports local relevance, while local results are mainly determined by relevance, distance, and prominence ([Google Business Profile local-ranking guidance](https://support.google.com/business/answer/7091?hl=en)).

The strongest keyword opportunities are:

1. **Solar installer / solar installation / solar company in Siargao** — the core commercial cluster.
2. **Hybrid solar, off-grid solar, solar battery storage, and brownout backup in Siargao** — a close match to Evergreen's installed systems and the island's search language.
3. **Solar cost / price / estimate in Siargao** — existing tool, strong commercial-investigation intent, but thin crawlable explanation compared with the visible leader.
4. **Construction company / contractor / house builder in Siargao** — broader and likely more commonly phrased than “frame construction,” provided Evergreen truly performs the full scope implied.
5. **Steel-frame / light-gauge steel construction in Siargao** — a differentiated, less-contested niche; likely lower demand and therefore a hypothesis to validate.
6. **Hardware supply / building materials / construction supplies in Siargao** — use the search language people use, but describe Evergreen truthfully as a supplier with Burgos warehouse pickup by arrangement, not as a customer-facing store.
7. **Cement board, marine plywood, phenolic board, rockwool, and SPC flooring in Siargao** — high-conversion long tails with little Siargao-specific web competition, but no reliable volume evidence.

No monthly search volumes are claimed in this report. Google explains that Trends is normalized rather than absolute and that low-volume terms can appear as zero; it also warns that Autocomplete is not a popularity ranking ([Google Trends FAQ](https://support.google.com/trends/answer/4365533?hl=en)). Search Console and Business Profile performance data are required to turn these directional findings into measured priorities.

## Owner-confirmed canonical business facts

Confirmed by the owner on 2026-08-25:

- **Evergreen Solar** is the official solar business name.
- The business serves **Siargao Island only**; Davao is not a current service location.
- The office is in **General Luna, Surigao del Norte**, and is **not open to the public**.
- Burgos is a **warehouse/pickup point by arrangement**, not a storefront, public office, or company address.
- Nova Tierra is the owner's private residence in Davao and must not be presented as a business or service location.
- The office/company address is shared with **MAD LAW Siargao**. Only the General Luna municipality and province were supplied for publication; no street address should be invented or exposed.

These facts supersede any conflicting interpretation in the public-source snapshot below. Dapa remains a citation/profile correction item, not a second service location unless the owner later confirms a specific public-facing role for it.

### Repository implementation status

The 2026-08-25 working changes now add explicit service-and-Siargao H1s, a Siargao-focused hardware-supply title, crawlable estimator context, individual solar project URLs, sitemap entries, and an Organization graph that uses Siargao as the service area. The graph identifies the General Luna office as a non-public `Place`; it does not invent a Burgos or Davao storefront. Contact, footer, and hardware copy label Burgos only as warehouse pickup by arrangement. These changes are local to the repository until deployed; Google, Facebook, Instagram, and directory profiles were not edited during this work.

## Method and evidence standard

This audit combined:

- the current repository and deployed HTML/headers;
- first-party Google Search Central and Google Business Profile documentation;
- a 2026-08-25 Google Suggest sample supplied during the audit;
- live search-result samples for solar, backup power, construction, steel framing, hardware, and building-material queries;
- the public pages of businesses and directories appearing in those samples.

### Evidence labels

| Label | Meaning |
|---|---|
| **Strong** | The phrase appeared in the Suggest sample, the live results showed a stable intent pattern, and Evergreen has an exact offer or proof. |
| **Medium** | Live results and Evergreen's actual offer align, but the phrase did not appear in the small Suggest sample. |
| **Hypothesis** | Strategically plausible and relevant, but there is no volume evidence and little or no Suggest support; validate before creating a standalone page. |

Suggest and result sampling are directional. Results vary by location, device, personalization, language, and time. A `site:` query is also not a complete index diagnostic. Search Console is the source of truth for the site's impressions, indexed URLs, and queries.

## What Google says matters for this audit

- Local results are mainly based on **relevance, distance, and prominence**. Complete profile data helps relevance; links and reviews are among the signals Google describes under prominence ([Google Business Profile local-ranking guidance](https://support.google.com/business/answer/7091?hl=en)).
- A verified Business Profile can expose the website, phone, address or service area, photos, and reviews in Search and Maps ([Google Business Profile overview](https://support.google.com/business/answer/7039811?hl=en-en)).
- Categories affect local ranking. Google recommends choosing the most specific primary category that describes what the business **is**, then only a few representative additional categories—not a category for every service ([category guidance](https://support.google.com/business/answer/7249669?hl=en); [representation guidelines](https://support.google.com/business/answer/3038177?hl=en-en)).
- Eligible businesses can list services, and Google may highlight a matching service when a local customer searches for it ([services guidance](https://support.google.com/business/answer/9455399?hl=en-GB)).
- Page titles should be unique, clear, concise, and accurately describe both the page and, where useful, the physical location. Search snippets often come from visible page content, not only the meta description ([SEO Starter Guide](https://developers.google.com/search/docs/fundamentals/seo-starter-guide); [title-link guidance](https://developers.google.com/search/docs/appearance/title-link)).
- Google recommends anticipating expert and novice vocabulary but says its language systems understand many variations; exact-match repetition is unnecessary ([SEO Starter Guide](https://developers.google.com/search/docs/fundamentals/seo-starter-guide)).
- Helpful content should demonstrate first-hand expertise and provide substantial value compared with other results ([people-first content guidance](https://developers.google.com/search/docs/fundamentals/creating-helpful-content)). Evergreen's real project specifications are the strongest available source for this.
- Creating near-duplicate town pages merely to funnel users to the same destination can be doorway abuse. Location pages should only exist when each contains substantial, unique local value ([Google spam policies](https://developers.google.com/search/docs/essentials/spam-policies#doorway-abuse)).

## Current-site baseline

### Strengths to preserve

| Area | Evidence |
|---|---|
| Crawlability | Production returned `200` for the homepage and main division pages; `robots.txt` allows crawling and references the sitemap. |
| Canonicals | Main pages have self-referencing `https://www.ever-green.ph/...` canonicals; the apex domain redirects to `www`. |
| Page separation | Solar, services, estimate, projects, construction, and hardware each have their own URL. |
| Local relevance | Siargao appears throughout page titles, descriptions, body copy, image alt text, project locations, contact details, and homepage JSON-LD. |
| First-party expertise | `config/projects.php` includes named projects, towns, system type, panels, inverters, batteries, warranties, and maintenance information. |
| Commercial utility | `/solar/estimate` calculates system size, cost, and savings; `/hardware` publishes a current price list. |
| Trust | The site shows testimonials, real project media, two phone numbers, email, WhatsApp, social links, and a map pin. |

### Gaps found in the repo and deployment at audit time

| Gap | Why it matters | Priority |
|---|---|---:|
| Sampled searches did not surface `ever-green.ph` for `site:ever-green.ph` or exact-brand queries. | Not proof of deindexing, but it warrants immediate Search Console inspection, sitemap submission, and URL Inspection on the main pages. | P0 |
| Siargao Finder says Dapa/no phone/Facebook, while owner-confirmed facts are Evergreen Solar, Siargao-only service, two site phones, and `ever-green.ph`. | Conflicting local citations can confuse people and weaken confidence that Google has one consistent entity record. | P0 |
| The public map link resolves to warehouse coordinates rather than an obviously named business-profile/place URL. | The warehouse must not be presented as a public office/storefront. Use a correct service-area Business Profile and only expose a pickup location where operationally appropriate. | P0 |
| Hardware title was `Evergreen Hardware Supply — Building Materials Price List`, without “Siargao.” | Missed the strongest local qualifier on the page; the replacement should say “hardware supply,” not imply a storefront. | P0 |
| Generic H1s: “Build for island living,” “Building materials, island-ready,” “Reliable solar for island living,” “We build projects that last,” and “Size your solar in 30 seconds.” | Attractive brand copy, but the most prominent visible heading does not always plainly name the service and place. Google may use headings as title-link inputs. | P0 |
| Solar-project data is rendered on one `/solar/projects` index; project slugs are not routes. | Named businesses, municipalities, technical specs, and media cannot each earn relevance, links, or branded/local queries on a durable URL. | P1 |
| Battery storage, off-grid systems, and maintenance are cards on broad pages. | Search intent is specific enough to justify richer landing sections or pages, especially because Evergreen has actual systems and specs. | P1 |
| Construction page emphasizes steel framing but does not clearly define scope, process, licensing/engineering roles, project types, service area, or pricing/quote inputs. | Users searching “contractor,” “builder,” or “construction company” need to know whether Evergreen handles frames only or full design/build execution. | P1 |
| Hardware page is a compact table with no category copy, brands, sheet dimensions, availability date, delivery area, or direct inquiry affordance per item. | Exact product searches are likely to require stock/location details, and page snippets can come from visible text. | P1 |
| Organization/LocalBusiness JSON-LD is on the homepage only; division nodes are generic `Organization` departments without durable IDs or division-specific contact/location details. | Homepage-only Organization markup is acceptable, but the graph could describe real divisions and their relationships more precisely. Google documents department markup for departments with distinct properties ([LocalBusiness documentation](https://developers.google.com/search/docs/appearance/structured-data/local-business#multiple-departments)). | P2 |
| Sitemap uses `priority` but has no `lastmod`. | Google says it ignores `priority` and `changefreq`; accurate `lastmod` can help crawl scheduling ([Google Search Central sitemap note](https://developers.google.com/search/blog/2023/06/sitemaps-lastmod-ping)). | P2 |
| An internal CTA links to `/construction/materials`, which redirects to `/hardware`. | Internal navigation should link directly to the canonical destination to avoid needless redirects and present a cleaner hierarchy. | P2 |

## Live search and competitor patterns

The table records the pattern in the sampled results, not permanent rankings.

| Query sample | Observed result pattern | Evergreen gap/opportunity |
|---|---|---|
| `solar installer siargao`, `solar panels siargao`, `solar company siargao`, `off grid solar siargao` | [Siargao Build's solar-cost guide](https://siargaobuild.com/blog/solar-power-costs-siargao) appeared prominently for several variants; accommodation pages describing their own off-grid solar also appeared. A clearly dominant local installer page was not evident in the sample. | Evergreen has the exact service and stronger installer proof but did not surface. Tighten `/solar`, expose individual installs, and strengthen the Business Profile/citations. |
| `solar cost siargao`, `solar price siargao`, `solar estimate siargao` | Siargao Build owns a substantial price-and-system comparison page and calculator pathway. [Sunwave](https://sunwave-asia.lovable.app/) exposes package prices, battery storage, a savings calculator, and maintenance claims. | Evergreen already has an estimator, but it needs crawlable Siargao-specific cost methodology, system examples, FAQs, and links to real quotes/projects. Do not copy competitor figures; use Evergreen's verified current data. |
| `solar battery siargao`, `battery backup siargao`, `power backup siargao` | Results mixed solar packages, outage guides, accommodation pages, generator content, and national suppliers. No obvious authoritative local battery-installer page dominated. | Strong opening for a Siargao battery-backup page supported by the existing Growatt/Calidad/LiFePO4 projects, warranties, and maintenance evidence. |
| `generator siargao supplier`, backup-power variants | Generator manufacturers/suppliers, a Siargao resort installation case, and [Siargao Build's generator-sizing guide](https://siargaobuild.com/blog/generator-sizing-siargao) appeared. | Do not target generator-purchase intent unless Evergreen truly sells/installs/services generators. A battery-vs-generator guide is possible only as a truthful comparison that clearly states Evergreen's actual offer. |
| `construction company siargao`, `contractor siargao`, `house builder siargao`, `resort construction siargao` | [Siargao Build's builder comparisons/guides](https://siargaobuild.com/blog/top-builders-siargao), directories, and [JLG Prime Builders](https://jlgprimebuilders.com/) appeared. JLG's homepage leads directly with building a property in Siargao and years of local activity. | Broaden the vocabulary on `/construction` if the scope is accurate: construction company, contractor, builder, homes/villas/resorts/commercial. Add process, scope, team/credentials, completed work, and quote requirements. |
| `steel frame construction siargao`, `light gauge steel framing siargao`, `LGS construction siargao` | Results were mostly national manufacturers, generic steel resources, and one Siargao modular-steel resort project; an obvious local specialist was absent. | Differentiated opportunity with low observed competition, but treat demand as unproven. Make a substantive steel-frame page rather than repeating one paragraph. |
| `hardware store siargao`, `building materials siargao`, `construction supplies siargao` | [Siargao Finder's supplier directory](https://www.siargaofinder.com/suppliers) and local store/listing pages dominated. The directory contains many municipality-specific hardware and supply entries. | Local profile completeness, accurate location, hours, phone, stock, pickup/delivery, and directory citations are as important as page copy. |
| `cement board siargao`, `marine plywood siargao`, `phenolic board siargao`, `SPC flooring siargao` | Samples largely returned national manufacturers/retailers or generic documents, not Siargao stockists. | Exact-match local product availability is an attractive long-tail gap. Start with rich sections on `/hardware`; create product URLs only if each can remain accurate and useful. |

### Brand/citation observation

Siargao Finder's supplier directory lists only two solar suppliers in the relevant portion of its page: “Evergreen Solar Siargao” as a Dapa/Siargao service-area business with no phone and Facebook as the website, and Onsolar Siargao in General Luna with a phone ([directory listing](https://www.siargaofinder.com/suppliers)). Evergreen Hardware Supply was not found in that directory sample. This makes claiming/correcting the listing and adding the hardware business—if the directory accepts verified updates—a concrete local-citation task.

### Public local-business information verification (checked 2026-08-25)

This is a public-source check, not a determination of which real-world location or business name is legally correct. “Not visible” means the field could not be verified in the publicly retrievable page, not that the business has no such information.

| Source | Confirmed public display | Discrepancy or inaccessible/unknown | Owner action needed |
|---|---|---|---|
| Evergreen [homepage](https://www.ever-green.ph/) and [contact page](https://www.ever-green.ph/contact) — first party | At audit time, the deployed site presented the group as **“Evergreen.”** Its JSON-LD named a Burgos local business and the divisions **“Evergreen Solar,” “Evergreen Frame Construction,”** and **“Evergreen Hardware Supply.”** It displayed **Burgos, Siargao** and **Nova Tierra, Davao City**, the phones **0966 305 1461** and **0977 127 5822**, email **simonphconsult@gmail.com**, and domain **ever-green.ph**. | That deployed location model conflicts with the later owner confirmation. No street address, public hours, or unambiguous primary phone was visible. | Deploy the repository corrections showing the non-public General Luna office, then confirm the preferred primary phone and whether any further address detail should be public. |
| [Facebook](https://www.facebook.com/evergreen.solar.mindanao/) — first party | Public page metadata displays **“Evergreen Solar Mindanao | Dapa”** and describes the business as **Evergreen Solar Mindanao**. | The name conflicts with **Evergreen Solar**, and Dapa is not established as a separate public business location. Phone, `ever-green.ph`, service-area details, category, and hours were not exposed in the retrievable public page. | Rename/align the page to Evergreen Solar, use the Siargao service area, and complete the About/contact fields with the owned domain and preferred phone. |
| [Instagram](https://www.instagram.com/evergreensolar.siargao/) — first party | The public profile displays **“Evergreen Solar Siargao”**, handle **@evergreensolar.siargao**, and bio **“Empowering Siargao and beyond with sustainable solar energy”** (followed by emoji). | “And beyond” conflicts with the confirmed Siargao-only focus. No phone, domain, email, category, or hours were exposed in the retrievable public profile. | Use Evergreen Solar as the display name, make the bio Siargao-only, and add the owned website and permitted contact details. |
| [Site-linked Google Maps pin](https://maps.app.goo.gl/td1LZpCJpKA7Vks69) and [exact-name Maps search](https://www.google.com/maps/search/?api=1&query=Evergreen%20Solar%20Siargao) — Google public surfaces | The site's short link resolves to a raw coordinate query for **10.0407276, 126.0705929**. | The coordinates identify the Burgos warehouse, not a confirmed Evergreen storefront/company office. A named Google Business Profile could not be confirmed in this check; this is not proof that none exists. | Verify or correct the service-area profile in Business Profile Manager. Do not use the warehouse pin as company NAP data and do not create a duplicate profile. |
| [Siargao Finder supplier directory](https://www.siargaofinder.com/suppliers) — third party | The listing displays **“Evergreen Solar Siargao,” “Solar Energy Systems Supplier,” “Dapa,”** and **“Dapa and Siargao Island service area.”** It says **“No phone listed”** and sends its website action to Evergreen's Facebook page. Its map action is a text search, not an identifiable Google place/profile link. | The Dapa label, missing phones, and Facebook-as-website data conflict with the confirmed Evergreen Solar/Siargao-only/owned-domain model. Evergreen Hardware Supply was not found in the sample. | Ask the directory to use Evergreen Solar, Siargao Island as the service area, `ever-green.ph`, and the preferred phone. Add hardware only if it can be maintained as an accurate supplier listing without a false storefront. |

**Verification conclusion:** The owner confirmation resolves the site's location model: Evergreen Solar serves Siargao only; its non-public office is in General Luna, Surigao del Norte; Burgos is a warehouse/pickup point by arrangement; and Nova Tierra is not a business location. The office/company address is shared with MAD LAW Siargao, but no street address was supplied for publication. Dapa remains inconsistent with the confirmed model and should be reviewed in Facebook and Siargao Finder. A named Google Business Profile, customer-facing hours, exact correspondence address, and preferred primary phone remain unconfirmed.

## Keyword and intent map

### Summary keyword-to-page matrix

| Priority cluster | Representative queries | Best landing page | Evidence | Recommended move |
|---|---|---|---|---|
| Siargao solar installer | `solar siargao`, `evergreen solar siargao`, `solar installer siargao`, `solar installation siargao`, `solar company siargao`, `solar panels siargao` | `/solar` | **Strong** for `solar siargao` and the branded phrase; **medium** for installer variants | Make the H1/service proposition explicit; link to system types, estimate, and case studies. |
| Battery/brownout backup | `solar battery siargao`, `battery backup siargao`, `siargao brownout backup`, `backup power siargao` | New `/solar/battery-backup` or a deep section first | **Strong** for brownout/power-outage language; **medium** for service variants | Build from verified LiFePO4 installations, loads, runtime, warranty, monitoring, and maintenance. |
| Off-grid/hybrid | `off grid solar siargao`, `hybrid solar siargao`, `solar with battery backup siargao` | New `/solar/off-grid` plus battery page | **Medium** | Explain selection criteria and connect to real villa/resort projects. |
| Solar cost/estimate | `solar cost siargao`, `solar price siargao`, `solar estimate siargao` | `/solar/estimate` | **Medium** | Add crawlable, dated methodology, inclusions/exclusions, scenarios, FAQs, and project proof. |
| Construction company | `siargao construction company`, `contractor siargao`, `builder siargao`, `building a house in siargao` | `/construction` | **Strong** | Define scope and use broad contractor/builder terms only if Evergreen truly performs that scope. |
| Steel framing | `steel frame construction siargao`, `light gauge steel framing siargao`, `LGS construction siargao` | `/construction` first; optional `/construction/steel-frame` | **Hypothesis to medium** | Deepen with process, engineering evidence, use cases, materials, and real projects; validate demand before splitting. |
| Hardware/building supplies | `hardware siargao`, `siargao hardware store`, `building materials siargao`, `construction supplies siargao` | `/hardware` | **Strong** | Lead with “hardware supply” and “building materials in Siargao”; explain Burgos warehouse pickup by arrangement, phone, stock, delivery, and price-update date without claiming a storefront. |
| Exact materials | `cement board siargao`, `marine plywood siargao`, `phenolic board siargao`, `rockwool siargao`, `SPC flooring siargao` | `/hardware` category anchors first | **Hypothesis** | Enrich product rows; add standalone URLs only if stock/content can stay accurate and useful. |
| Generator | `generator siargao`, `generator supplier siargao` | No money page unless service is confirmed | Out-of-scope | At most, publish an expert-reviewed battery-vs-generator comparison that states Evergreen's actual offer. |

### 1. Solar installation — core money page

**Recommended target:** `/solar`

| Cluster | Suggested language | Intent | Evidence |
|---|---|---|---|
| Primary | `solar siargao`, `evergreen solar siargao`, `solar installer siargao`, `solar installation siargao`, `solar company siargao`, `solar panels siargao` | Hire/quote | `solar siargao` and branded: **strong**; installer variants: **medium** |
| System types | `hybrid solar siargao`, `off grid solar siargao`, `grid tied solar siargao` | Compare/hire | **Medium** |
| Audience | `residential solar siargao`, `commercial solar siargao`, `solar for resort siargao`, `solar for villa siargao` | Find fit | **Medium**; project evidence exists |
| Trust | `local solar installer siargao`, `solar maintenance siargao`, `solar repair siargao` | Vet provider/after-sales | Installer/maintenance: **medium**; repair: **hypothesis unless offered** |

Recommended page promise: **“Solar installation for Siargao homes, villas, resorts, and businesses.”** Use “solar installer” naturally in body copy, service links, and one heading; do not repeat every variation.

### 2. Battery backup, hybrid, and off-grid solar

**Recommended targets:** substantive new pages such as `/solar/battery-backup` and `/solar/off-grid`, or deeply expanded anchored sections first.

| Cluster | Suggested language | Intent | Evidence |
|---|---|---|---|
| Battery | `solar battery siargao`, `battery storage siargao`, `battery backup siargao`, `home battery backup siargao` | Compare/hire | **Medium** |
| Outages | `siargao brownout backup`, `siargao power outage backup`, `backup power siargao` | Solve immediate problem | **Strong** for brownout/power-outage language; service match is strong |
| Hybrid | `hybrid solar system siargao`, `solar with battery backup siargao` | Compare/hire | **Medium** |
| Off-grid | `off grid solar siargao`, `off grid solar for villa siargao`, `off grid power siargao` | Compare/hire | **Medium** |
| Equipment | `LiFePO4 battery siargao`, `Growatt battery siargao`, `solar inverter siargao` | Technical/product | **Hypothesis**; use as supporting language where the installed equipment is verified |

The page should answer load sizing, runtime, essential versus whole-property loads, salt-air protection, switching behavior, warranties, monitoring, maintenance, and the difference between hybrid and fully off-grid systems. Real project examples should link to full case studies.

### 3. Solar price, cost, and estimate

**Recommended target:** `/solar/estimate`

| Cluster | Suggested language | Intent | Evidence |
|---|---|---|---|
| Cost | `solar cost siargao`, `solar price siargao`, `solar panel installation cost siargao` | Commercial investigation | **Medium** |
| Tool | `solar estimate siargao`, `solar calculator siargao`, `solar savings siargao` | Calculate/lead | **Medium** |
| Comparisons | `hybrid solar cost siargao`, `off grid solar cost siargao`, `solar battery cost siargao` | Compare systems | **Medium** |

The tool needs a crawlable explanation below it: what inputs change price, representative system scenarios based on current Evergreen quotes, what is and is not included, why a site survey matters, and a clearly dated assumptions note. Avoid publishing unverified SIARELCO rates, payback claims, or fixed prices.

### 4. Construction and contractor intent

**Recommended target:** `/construction`, with a possible deeper `/construction/steel-frame` page.

| Cluster | Suggested language | Intent | Evidence |
|---|---|---|---|
| Core | `siargao construction company`, `contractor siargao`, `construction contractor siargao`, `builder siargao` | Hire/shortlist | **Strong** |
| Residential | `house builder siargao`, `home construction siargao`, `building a house in siargao`, `villa builder siargao` | Plan/hire | **Strong to medium** |
| Hospitality | `resort construction siargao`, `commercial construction siargao` | Hire | **Medium** |
| Differentiator | `steel frame construction siargao`, `light gauge steel framing siargao`, `LGS construction siargao`, `termite proof construction siargao` | Find specialist | **Hypothesis to medium**; sparse competition but no volume evidence |
| Resilience | `typhoon resistant construction siargao`, `coastal construction siargao` | Research/vet | **Hypothesis**; claims require engineering review and evidence |

Important scope constraint: use “general contractor,” “design-build,” “turnkey,” “architect,” or “engineer” only if the business's actual contracts, registrations, staff, and delivery scope support those words. If Evergreen supplies and erects the steel frame but does not deliver a whole build, the page should say so plainly and target **steel-frame contractor** rather than broad whole-house promises.

### 5. Hardware and building materials

**Recommended target:** `/hardware`

| Cluster | Suggested language | Intent | Evidence |
|---|---|---|---|
| Supplier/category | `hardware siargao`, `siargao hardware store`, `hardware store siargao`, `building materials siargao`, `construction supplies siargao` | Call/buy | **Strong** search language; publish “hardware supply” rather than “store” unless a storefront becomes eligible |
| Warehouse/pickup | `hardware burgos siargao`, `building materials burgos siargao` | Nearby purchase | **Medium/hypothesis**; warehouse pickup by arrangement |
| Dapa | `hardware in dapa siargao` surfaced in Suggest | Nearby purchase | **Strong language signal but not a target** unless there is a real Dapa branch or verified delivery proposition |
| Boards | `cement board siargao`, `Shera board siargao`, `marine plywood siargao`, `phenolic board siargao` | Product/price/stock | **Hypothesis**, high conversion fit |
| Insulation/flooring | `rockwool siargao`, `SPC flooring siargao` | Product/price/stock | **Hypothesis** |
| Price | `building materials price list siargao`, `[product] price siargao` | Compare/buy | **Medium to hypothesis** |

Recommended visible information: the Siargao service area, Burgos warehouse pickup-by-arrangement process, phone/WhatsApp, last price-update date, sheet dimensions, brand, stock status or “confirm availability,” minimum/bulk quantities, accepted payment methods, and verified delivery coverage. Do not publish storefront hours or directions unless customers are genuinely received there during those hours.

### 6. Town and municipality language

Use **General Luna, Dapa, Burgos, Pacifico/San Isidro, and Santa Monica** where first-party evidence supports them:

- Burgos: warehouse pickup area and Casa Cahuenga project; do not describe it as the company office or storefront.
- General Luna: Sunlit Hostel project.
- Dapa: Roxy project and existing coverage claim.
- Pacifico, San Isidro: Bamboo Surf Beach Resort project.
- Santa Monica: Filmegz Seaside project.

Do not immediately create five near-identical “solar installer in [town]” pages. Individual project pages are a safer, more useful way to establish local proof. A municipality landing page should only be added later if it can include unique projects, logistics, service details, local FAQs, and a distinct user need.

## Recommended page and content architecture

```text
/solar
├── /solar/services
├── /solar/battery-backup        (new, if enough unique substance)
├── /solar/off-grid              (new, if enough unique substance)
├── /solar/estimate
└── /solar/projects
    ├── /solar/projects/dayo-siargao
    ├── /solar/projects/bamboo-surf
    ├── /solar/projects/sunlit-hostel
    ├── /solar/projects/filmegz-seaside
    └── ...

/construction
└── /construction/steel-frame    (optional after the main page is deepened)

/hardware
└── product/category anchors first; standalone product URLs only when content and stock can stay useful
```

Each project URL should include:

- customer/property name and municipality;
- property/use case (home, hostel, villa, resort, restaurant);
- problem and constraints;
- system type and why it was chosen;
- verified panel, inverter, and battery specifications;
- installation/process notes;
- commissioning, monitoring, warranty, and maintenance facts;
- original images/video with descriptive captions;
- a relevant quote/CTA;
- links back to the matching service and estimate pages.

This is people-first content based on work Evergreen performed, and it gives clients a useful page they can naturally link to.

## Google Business Profile and local-entity work

### P0 verification checklist

1. Confirm whether a claimed and verified Google Business Profile exists for Evergreen Solar as a **Siargao service-area business**. Do not use the Burgos warehouse pin as the company-office location.
2. Configure the profile as a service-area business. Use the real General Luna office address for verification if Google requires it, but hide it from the public because customers are not received there.
3. Use the confirmed name **Evergreen Solar**, Siargao-only service area, `ever-green.ph`, and verified phones. Confirm the preferred primary phone, correspondence-address format, and any customer-facing hours before publishing them.
4. Reconcile the Dapa label across Facebook and Siargao Finder. Keep Burgos only as warehouse pickup by arrangement, not as NAP/address data.
5. Choose the most specific category available in the live Business Profile editor. Candidate concepts to check—not guaranteed category names—are solar energy company/supplier, construction company/contractor, and hardware store.
6. Add only services actually delivered: solar installation, grid-tied/hybrid/off-grid systems, battery storage, audits, monitoring/maintenance, steel framing, and stocked materials.
7. Remove the generic warehouse pin from business-address surfaces and link to the claimed service-area profile when available.
8. Add accurate exterior/interior/team/project/product photos. Google specifically recommends representative, in-focus photos and notes that photos help businesses stand out ([photo guidance](https://support.google.com/business/answer/6123536?hl=en)).
9. Ask completed-project customers for honest Google reviews and reply to them. Never gate, buy, or script positive reviews.

### One group profile or three division profiles?

Do not create duplicate profiles just to rank each keyword family. Google permits separate department profiles only when departments are independently public-facing and meet its real-world eligibility rules. If Solar, Frame Construction, and Hardware have distinct signage, categories, customer access, hours/phones, and operations, assess separate eligible profiles; otherwise use one accurate profile plus clear services and site landing pages. See Google's [business representation guidelines](https://support.google.com/business/answer/3038177?hl=en-en) and [department category guidance](https://support.google.com/business/answer/7249669?hl=en).

### Local citations and links

- Claim/update the Siargao Finder entry with the owner-confirmed NAP and `ever-green.ph`; add Hardware if it is eligible for the directory.
- Audit Discover Siargao and other genuinely used local directories for missing or conflicting entries; prioritize quality and local relevance over citation quantity.
- Give featured clients a useful project page they may choose to link from their own accommodation/business sites.
- Pursue natural relationships with architects, resorts, builders, suppliers, and community organizations. Google's local-ranking guidance explicitly mentions links and reviews as prominence inputs.
- The new friends/local-business section is community-positive, but outbound directory entries alone should not be treated as a major ranking tactic.

## On-page recommendations by URL

These are positioning examples, not final copy.

| URL | Current issue | Suggested direction |
|---|---|---|
| `/solar` | Title is good; H1 “Powering Siargao” lacks the explicit service. | H1 or nearby primary heading: “Solar installation built for Siargao.” Add a concise homes/villas/resorts/businesses line and links to battery, off-grid, estimate, and case studies. |
| `/solar/services` | Broad services grid; battery/maintenance content is shallow. | H1: “Solar installation, battery storage & maintenance in Siargao.” Expand each major service with process, outputs, eligibility, and relevant proof. |
| `/solar/estimate` | Strong tool but H1/title do not both explicitly include Siargao; limited crawlable decision support. | Title/H1 direction: “Solar cost & savings estimate for Siargao.” Add dated methodology, inclusions/exclusions, system scenarios, FAQs, and project links. |
| `/solar/projects` | Generic H1 and all projects share one URL. | H1: “Solar installations across Siargao.” Add individual case-study routes with unique titles, descriptions, and internal links. |
| `/construction` | Generic H1; ambiguous whole-build versus frame-only scope. | H1: “Steel-frame construction in Siargao.” Add a truthful scope statement and naturally use contractor/builder/company terms only where accurate. |
| `/hardware` | Title omitted Siargao; generic H1; table lacks supplier details. | Title: “Building Materials & Hardware Supply in Siargao | Evergreen.” H1: “Building materials & hardware supply in Siargao.” Explain Burgos warehouse pickup by arrangement; add last-updated date, product descriptions, stock inquiry, and verified delivery facts. |
| `/contact` | The page incorrectly presented Burgos and Nova Tierra as offices. | Show “Office: General Luna, Surigao del Norte,” state that it is not open to the public, and explain Burgos warehouse pickup by arrangement. Do not invent a street address. |

## Structured data recommendations

The homepage Organization graph is the right starting point. Model the General Luna office as a non-public `Place`, not as a customer-facing `LocalBusiness`; do not model Burgos or Nova Tierra as business locations. Google says Organization markup can live on the homepage or one organization page and does not need to be repeated everywhere ([Organization documentation](https://developers.google.com/search/docs/appearance/structured-data/organization)). The opportunity is accuracy and entity clarity, not schema volume.

Using the owner-confirmed facts:

- use stable `@id` values for the group, Siargao service area, and real divisions;
- identify Siargao as the divisions' `areaServed`; do not attach them to a false Burgos or Davao business location;
- keep the General Luna office's `publicAccess` false; add a street address, primary phone, profile URL, or customer-facing hours only when verified and eligible for public display;
- make `sameAs` links point to the current official profiles;
- describe divisions as departments only if that reflects actual organization;
- connect division URLs to their department IDs and parent organization;
- validate with Google's Rich Results Test and Schema Markup Validator;
- do not add self-serving LocalBusiness review markup expecting review stars—publish testimonials for users and maintain reviews on the Business Profile.

Structured data supports understanding and eligibility; it is not a substitute for an accurate Business Profile, useful content, or local prominence.

## 90-day prioritized action plan

### Days 1–14 — P0

1. **Open Search Console:** verify the domain property, submit `/sitemap.xml`, inspect `/`, `/solar`, `/solar/services`, `/solar/estimate`, `/solar/projects`, `/construction`, and `/hardware`, and record indexing/canonical status. Google recommends using the Performance report's Queries, Pages, Countries, and devices to identify impressions and CTR opportunities ([Search Console guidance](https://support.google.com/webmasters/answer/10268906?hl=en)).
2. **Correct the local entity:** claim/verify Evergreen Solar as a Siargao service-area Business Profile; remove Nova Tierra and false Burgos-office signals; reconcile Dapa, phone, and website citation differences.
3. **Make titles and H1s explicit:** prioritize hardware, construction, solar services, estimate, projects, and contact. Preserve brand voice in supporting text rather than leaving the core service implicit.
4. **Complete Business Profile fields:** correct category, services, website, phones, location/service area, hours, photos, and review workflow.
5. **Fix controlled citations:** update Facebook About details and Siargao Finder once the owner confirms the canonical NAP.

### Days 15–45 — P1

1. Create individual solar project routes, starting with Bamboo Surf (Pacifico/San Isidro), Sunlit Hostel (General Luna), Filmegz Seaside (Santa Monica), and Dayo Siargao because their technical details are strongest.
2. Build a substantive battery-backup/hybrid page using verified project evidence.
3. Expand the off-grid proposition and connect it to off-grid project case studies.
4. Deepen `/construction` with exact scope, process, island constraints, engineering/design evidence, materials, project types, and quote requirements.
5. Upgrade `/hardware` from a bare price table to a local stock/pickup page; add product anchors and a visible “prices updated” date.
6. Link every new page from the relevant division page, projects index, sitemap, and footer/contextual navigation.

### Days 46–90 — P2, guided by early data

1. Use Search Console impressions and leads to decide whether steel framing, individual hardware products, solar maintenance, or town pages deserve standalone URLs.
2. Publish first-party guides only where Evergreen can add island-specific expertise: sizing backup loads, hybrid versus off-grid, maintaining panels in salt air, planning solar during a villa build, or choosing board materials for humid coastal sites.
3. Add accurate sitemap `lastmod` values and stop treating `priority` as meaningful to Google.
4. Strengthen the entity graph after business/location facts are finalized.
5. Build natural links through project clients and local professional/community partnerships.

## Measurement plan

### Search Console

Track non-brand and brand query families separately:

- Brand: `evergreen`, `ever green`, `evergreen solar siargao`.
- Solar core: `solar`, `installer`, `installation`, `panel` combined with `siargao` or a municipality.
- Backup: `battery`, `backup`, `hybrid`, `off grid`, `brownout`, `power outage`.
- Construction: `construction`, `contractor`, `builder`, `steel frame`, `light gauge`, `house`, `villa`, `resort`.
- Hardware: `hardware`, `building material`, `construction supply`, `cement board`, `plywood`, `phenolic`, `rockwool`, `spc`.
- Local modifiers: `siargao`, `general luna`, `dapa`, `burgos`, `pacifico`, `san isidro`, `santa monica`.

Compare clicks, impressions, CTR, and average position by **query cluster and landing page**, filtered to the Philippines where useful. Search Console omits anonymized queries and may truncate query rows, so totals and exported rows will not always match perfectly ([Search Console dimensions and limitations](https://support.google.com/webmasters/answer/17011259?hl=en)).

### Business Profile

Record the baseline before edits, then monitor:

- search terms shown in profile performance;
- website clicks, calls, directions, and messages where available;
- review count, rating, response rate, and review themes;
- photo views/engagement;
- actions by division/service if links can be tagged distinctly.

### Leads and business outcomes

Tag lead source and landing page. Measure qualified quote requests—not only rankings—for solar, construction, and hardware. For hardware, also track calls/messages asking about stock, bulk pricing, pickup, and delivery.

## Next Google-ability opportunities (post-implementation)

This is the remaining-work shortlist after the repository changes described above. It does not repeat completed work such as explicit local H1s, individual project routes, estimator context, the Siargao service-area graph, or project sitemap entries. Because those changes are not yet deployed, deployment and measurement come before another broad round of page creation.

| Priority | Surface | Remaining action | Impact / effort |
|---|---|---|---|
| **P0** | Deployment + Search Console | Deploy the current changes, verify the Search Console domain property, submit the updated sitemap, and inspect the homepage, main service pages, estimator, projects index, and a sample of the new project URLs. Request indexing only for the most important changed URLs, then monitor Page indexing and the selected canonical; repeated requests do not accelerate crawling. A sitemap is a discovery hint, not an indexing guarantee ([Search Console property guidance](https://support.google.com/webmasters/answer/34592?hl=en); [Google recrawl guidance](https://developers.google.com/search/docs/crawling-indexing/ask-google-to-recrawl); [sitemap guidance](https://developers.google.com/search/docs/crawling-indexing/sitemaps/build-sitemap)). | **Very high / low** |
| **P0** | Business Profile + controlled citations | Have Evergreen keep primary ownership and grant the agency Manager access to the existing profile; do not create a duplicate. Align the profile, Facebook, Instagram, and Siargao Finder around **Evergreen Solar**, `ever-green.ph`, the verified primary phone, and Siargao-only service. Complete categories, services, description, photos, and other truthful fields. Google says complete profile data supports relevance, while links and reviews contribute to prominence ([owner/manager permissions](https://support.google.com/business/answer/3403100?hl=en); [local-ranking guidance](https://support.google.com/business/answer/7091?hl=en)). | **Very high / medium** |
| **P1** | Repository content | Deepen the best project URLs first—Bamboo Surf, Sunlit Hostel, Filmegz Seaside, and Dayo—because the routes now exist but the detail pages still rely mainly on generic template copy and equipment lists. Add the customer's use case, site constraint, design choice, installation/commissioning process, verified result, date, original captions, and contextual links to the relevant service and estimator. This is more defensible than producing many thin town pages: Google recommends first-hand, people-first material, and descriptive internal links help Google understand and discover pages ([people-first content guidance](https://developers.google.com/search/docs/fundamentals/creating-helpful-content); [SEO Starter Guide](https://developers.google.com/search/docs/fundamentals/seo-starter-guide)). | **High / medium** |
| **P1** | Reviews, photos, and earned links | Establish a repeatable handoff after each completed installation: ask the real customer for an honest Google review using the profile's review link, reply to every substantive review, add representative project/team photos, and give the client its case-study URL to link or share if useful. Never offer incentives or selectively solicit only positive reviews. Google explicitly identifies reviews and links as local-prominence inputs and prohibits fake engagement ([review guidance](https://support.google.com/business/answer/3474122?hl=en); [Maps contribution policy](https://support.google.com/contributionpolicy/answer/7400114?hl=en); [local-ranking guidance](https://support.google.com/business/answer/7091?hl=en)). | **High / medium, ongoing** |
| **P1** | Data-led content | Wait for query and lead evidence before choosing the next standalone page. The leading hypotheses remain battery/brownout backup, off-grid solar, steel framing, and high-value hardware categories. Promote a hypothesis only when Search Console shows relevant impressions or the sales log shows repeated qualified questions; Google recommends using Queries, Pages, impressions, clicks, and CTR to find content and snippet opportunities ([Search Console Performance guidance](https://support.google.com/webmasters/answer/17010961?hl=en)). | **High / medium** |
| **P2** | Technical repository work | Replace sitemap `<priority>` values with accurate `<lastmod>` dates only when the application can maintain them reliably; Google ignores `priority` and uses `lastmod` only when it is consistently accurate. After deployment, use Search Console's Core Web Vitals report and PageSpeed Insights on the image-heavy project pages and estimator, then optimize only demonstrated LCP, INP, or CLS problems ([sitemap guidance](https://developers.google.com/search/docs/crawling-indexing/sitemaps/build-sitemap); [Core Web Vitals guidance](https://developers.google.com/search/docs/appearance/core-web-vitals)). | **Medium / low to medium** |

### Local browser spot-check

The estimator is already substantial and crawlable; more generic calculator copy is not the next priority. Before deployment, the owner should verify or soften its electricity-rate, simple-payback, “25+ years,” warranty, and carbon-equivalence claims so every number has a dated internal source and states material exclusions. This supports the reliable, first-hand standard Google asks site owners to apply to people-first content ([people-first content guidance](https://developers.google.com/search/docs/fundamentals/creating-helpful-content)).

A representative new project detail page had a unique title, description, canonical, local H1, visible breadcrumb, equipment specifications, and descriptive image alt text. Its indexable substance was still mostly template copy and a gallery; it had no JSON-LD, and the project images had no explicit dimensions or responsive sources. Content depth comes first. Afterwards, add `BreadcrumbList` markup, consider a representative `primaryImageOfPage`, and use measured image/CWV work rather than speculative optimization ([breadcrumb documentation](https://developers.google.com/search/docs/appearance/structured-data/breadcrumb); [image SEO guidance](https://developers.google.com/search/docs/appearance/google-images)).

### Non-public General Luna office: safe Business Profile setup

Use one service-area profile for Evergreen Solar. Enter the real General Luna street address if Google requires it for verification, but turn off **Show business address to customers** because customers are not received there; the public profile should show only genuine Siargao service areas. Google allows up to 20 named cities, postal codes, or other areas rather than a radius and says a service-area business should normally have one profile for the whole area ([address guidance](https://support.google.com/business/answer/2853879?hl=en); [service-area guidance](https://support.google.com/business/answer/9157481?hl=en); [representation guidelines](https://support.google.com/business/answer/3038177?hl=en)).

Keep the public website at municipality level—“General Luna, Surigao del Norte; not open to the public”—without a street address, public-office hours, directions link, or map pin. Do not create a separate Burgos warehouse profile unless it later becomes a genuinely customer-facing, permanently signed, and staffed location during stated hours. Pickup by arrangement does not establish that storefront model.

### Measurement and access prerequisites

Before judging the next content target, obtain:

- **Search Console owner/full-user access:** record index status and export at least a pre-deployment and post-deployment view of Queries and Pages, separating brand from non-brand and filtering to the Philippines where useful. Compare impressions and clicks first; treat average position as supporting context.
- **Business Profile Manager access:** capture the baseline search terms, views, calls, website clicks, messages, and other available interactions, then review monthly. Google notes that only metrics applicable to the profile appear ([Business Profile performance guidance](https://support.google.com/business/answer/9918094?hl=en)).
- **Conversion evidence:** record the landing page and service requested for every qualified call, WhatsApp conversation, form submission, and quote. Search visibility without qualified Siargao leads is not the success criterion.
- **Verified operating data:** confirm the preferred primary phone, customer-contact hours, actual service menu, project dates/outcomes, hardware availability/update owner, and any claims requiring engineering or licensing support before publishing them.

## Limitations and decisions still needed

- No Search Console, Analytics, Business Profile dashboard, call-tracking, or lead-conversion data was available.
- No Google Ads Keyword Planner export or reliable monthly volume data was available. Suggest is language evidence, not volume.
- Search-result samples are snapshots and are not a rank tracker.
- The owner confirmed Evergreen Solar, Siargao-only service, the non-public General Luna office, and the Burgos warehouse model, but the audit did not verify legal entity names, licenses, Business Profile ownership, the exact MAD LAW Siargao street address, customer-facing hours, delivery areas, preferred primary phone, or whether each division qualifies for its own profile.
- Generator sales/installation/service are not evidenced in the repo. Generator money terms should remain out of scope unless the owner confirms the offer.
- “Contractor,” “design-build,” “turnkey,” “architect,” “engineer,” “typhoon-proof,” and warranty/performance claims require owner and technical review before publication.
- Product prices and availability change. Any expanded hardware content needs a reliable update owner and visible freshness policy.

## Bottom line

Evergreen does not need dozens of keyword-stuffed pages. It needs one consistent Siargao service-area entity, a complete Business Profile, explicit service-and-location headings, and indexable pages built from real work. The clearest remaining wins are to correct Dapa and other off-site citations, keep Burgos clearly labeled as warehouse pickup only, expose solar projects as case studies, and build the battery/off-grid cluster around Evergreen's strongest proof.
