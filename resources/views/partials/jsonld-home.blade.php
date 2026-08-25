@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "https://www.ever-green.ph/#org",
      "name": "Evergreen",
      "description": "An island group of businesses — Evergreen Solar, Evergreen Frame Construction, and Evergreen Hardware Supply — powering and building homes across Siargao, Philippines.",
      "url": "https://www.ever-green.ph/",
      "logo": "https://www.ever-green.ph/assets/logo-full.png",
      "image": "https://www.ever-green.ph/assets/og-cover.png",
      "email": "simonphconsult@gmail.com",
      "telephone": ["+639663051461", "+639771275822"],
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "telephone": "+639663051461",
          "contactType": "customer service",
          "areaServed": "Siargao Island"
        },
        {
          "@type": "ContactPoint",
          "telephone": "+639771275822",
          "contactType": "customer service",
          "areaServed": "Siargao Island"
        }
      ],
      "areaServed": { "@id": "https://www.ever-green.ph/#siargao" },
      "location": { "@id": "https://www.ever-green.ph/#general-luna-office" },
      "sameAs": [
        "https://www.facebook.com/evergreen.solar.mindanao/",
        "https://www.instagram.com/evergreensolar.siargao/"
      ],
      "subOrganization": [
        { "@id": "https://www.ever-green.ph/#solar" },
        { "@id": "https://www.ever-green.ph/#construction" },
        { "@id": "https://www.ever-green.ph/#hardware" }
      ],
      "department": [
        { "@id": "https://www.ever-green.ph/#solar" },
        { "@id": "https://www.ever-green.ph/#construction" },
        { "@id": "https://www.ever-green.ph/#hardware" }
      ]
    },
    {
      "@type": "AdministrativeArea",
      "@id": "https://www.ever-green.ph/#siargao",
      "name": "Siargao Island",
      "containedInPlace": {
        "@type": "AdministrativeArea",
        "name": "Surigao del Norte, Philippines"
      }
    },
    {
      "@type": "Place",
      "@id": "https://www.ever-green.ph/#general-luna-office",
      "name": "Evergreen office",
      "description": "Non-public office in General Luna, Surigao del Norte",
      "publicAccess": false,
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "General Luna",
        "addressRegion": "Surigao del Norte",
        "addressCountry": "PH"
      }
    },
    {
      "@type": "Organization",
      "@id": "https://www.ever-green.ph/#solar",
      "name": "Evergreen Solar",
      "url": "https://www.ever-green.ph/solar",
      "description": "Grid-tied, off-grid, and hybrid solar installation, battery storage, and maintenance for Siargao homes and businesses.",
      "logo": "https://www.ever-green.ph/assets/logo-full.png",
      "telephone": "+639663051461",
      "email": "simonphconsult@gmail.com",
      "parentOrganization": { "@id": "https://www.ever-green.ph/#org" },
      "areaServed": { "@id": "https://www.ever-green.ph/#siargao" },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Evergreen Solar services",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": { "@type": "Service", "name": "Solar panel installation" }
          },
          {
            "@type": "Offer",
            "itemOffered": { "@type": "Service", "name": "Hybrid and off-grid battery storage" }
          },
          {
            "@type": "Offer",
            "itemOffered": { "@type": "Service", "name": "Solar maintenance and monitoring" }
          }
        ]
      }
    },
    {
      "@type": "Organization",
      "@id": "https://www.ever-green.ph/#construction",
      "name": "Evergreen Frame Construction",
      "url": "https://www.ever-green.ph/construction",
      "description": "Light-gauge steel-frame construction for homes, resorts, and commercial projects across Siargao.",
      "logo": "https://www.ever-green.ph/assets/logo-full.png",
      "telephone": "+639663051461",
      "email": "simonphconsult@gmail.com",
      "parentOrganization": { "@id": "https://www.ever-green.ph/#org" },
      "areaServed": { "@id": "https://www.ever-green.ph/#siargao" },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Evergreen Frame Construction services",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": { "@type": "Service", "name": "Light-gauge steel-frame construction" }
          },
          {
            "@type": "Offer",
            "itemOffered": { "@type": "Service", "name": "Steel-frame design and engineering" }
          }
        ]
      }
    },
    {
      "@type": "Organization",
      "@id": "https://www.ever-green.ph/#hardware",
      "name": "Evergreen Hardware Supply",
      "url": "https://www.ever-green.ph/hardware",
      "description": "Building materials for island construction, including cement board, marine plywood, phenolic board, rockwool, and SPC flooring, with Burgos warehouse pickup by arrangement.",
      "logo": "https://www.ever-green.ph/assets/logo-full.png",
      "telephone": "+639663051461",
      "email": "simonphconsult@gmail.com",
      "parentOrganization": { "@id": "https://www.ever-green.ph/#org" },
      "areaServed": { "@id": "https://www.ever-green.ph/#siargao" },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Evergreen Hardware Supply products and services",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": { "@type": "Service", "name": "Building material supply and Burgos warehouse pickup by arrangement" }
          },
          {
            "@type": "Offer",
            "itemOffered": { "@type": "Service", "name": "Project and bulk material quotations" }
          }
        ]
      }
    }
  ]
}
</script>
@endverbatim
