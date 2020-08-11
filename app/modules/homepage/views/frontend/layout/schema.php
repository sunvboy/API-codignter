<script type='application/ld+json'>{

	"@context":"https://schema.org",

	"@type":"WebSite",

	"@id":"#website",

	"url":"<?php echo BASE_URL; ?>",

	"name":"<?php echo $this->fcSystem['homepage_company']; ?>",

	"alternateName":"Công ty TNHH phần mềm OVN",

	"potentialAction":{"@type":"SearchAction",

	"target":"<?php echo BASE_URL; ?>?s={search_term_string}",

	"query-input":"required name=search_term_string"}}
</script>
<script type='application/ld+json'>
    {"@context":"https://schema.org",

	"@type":"Organization",

	"url":"<?php echo BASE_URL; ?>",

	"sameAs":[],

	"@id":"#organization",

	"name":"Công ty TNHH phần mềm OVN",

	"logo":"<?php echo $this->fcSystem['homepage_logo']; ?>"}


</script>
<script type="application/ld+json">
    {

		"@context": "https://schema.org",

	  	"@type": "Professionalservice",

		"@id":"<?php echo BASE_URL; ?>",

		"url": "<?php echo BASE_URL; ?>",

		"logo": "<?php echo $this->fcSystem['homepage_logo']; ?>",

	    "image":"<?php echo $this->fcSystem['homepage_logo']; ?>",

	    "priceRange":"100$-30000$",

		"hasMap": "https://www.google.com/maps/place/C%C3%B4ng+Ty+TNHH+Ph%E1%BA%A7n+M%E1%BB%81m+T%C3%A2m+Ph%C3%A1t/@21.0287281,105.7723359,13z/data=!4m8!1m2!2m1!1zQ8O0bmcgdHkgdMOibSBwaMOhdA!3m4!1s0x3135ab69812c003f:0x256b856ddb89cded!8m2!3d21.0287281!4d105.8073548",

		"email": "<?php echo $this->fcSystem['contact_email']; ?>",

	    "founder": "Nguyễn Văn Quyền",

	     	"address": {

	    	"@type": "PostalAddress",

	    	"addressLocality": "Hà Nội",

	          "addressCountry": "VIỆT NAM",

	    	"addressRegion": "Hà Nội",

	    	"postalCode":"100000",

	    	"streetAddress": "Số 55 Ngõ 649, Ngọc Khánh, Ba Đình, Hà Nội, Vietnam"

	  	},

	  	"description": "<?php echo $this->fcSystem['seo_meta_description']; ?>",

		"name": "<?php echo $this->fcSystem['homepage_company']; ?>",

	  	"telephone": "<?php echo $this->fcSystem['contact_hotline']; ?>",

	 	"openingHours": [ "Mo-Sun 07:00-21:00" ],

	  	"geo": {

	    	"@type": "GeoCoordinates",

			"latitude": "20.971631",

			"longitude": "105.843570"

	 		},

	 "sameAs" : [ "<?php echo $this->fcSystem['social_facebook']; ?>"]

		}


</script>
<script type="application/ld+json">{

	  "@context": "https://schema.org",

	  "@type": "Person",

	  "name": "Nguyễn Văn Quyền",

	  "jobTitle": "Ceo",

	  "image" : "<?php echo $this->fcSystem['homepage_logo']; ?>",

	   "worksFor" : "<?php echo $this->fcSystem['homepage_company']; ?>",

	  "url": "<?php echo site_url('gioi-thieu'); ?>",

	"sameAs":["https://www.facebook.com/quyen.57" ],

	"AlumniOf" : [ "THPT Nam Khoái Châu", "Đại Học Công Nghiệp Hà Nội",

	"VFU university" ],

	"address": {

	  "@type": "PostalAddress",

	    "addressLocality": "Ha Noi",

	    "addressRegion": "vietnam"

		 }
		 }


</script>
<script type="application/ld+json">

	      {

	      "@context": "https://schema.org",

	      "@type": "WebSite",

	      "url": "<?php echo BASE_URL; ?>",

	      "potentialAction": {

			"@type": "SearchAction",

	      	"target": "<?php echo BASE_URL; ?>/?keyword={search_term_string}",

	      	"query-input": "required name=search_term_string"

	      }

	   }


</script>