define({ "api": [
  {
    "type": "get",
    "url": "/lastname/details",
    "title": "Get last names details",
    "name": "getDetails",
    "group": "Lastname",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Mixed",
            "optional": false,
            "field": "data",
            "description": "<p>Last name stats</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Lastname"
  },
  {
    "type": "get",
    "url": "/lastname/list",
    "title": "Get last names list",
    "name": "getList",
    "group": "Lastname",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "letter",
            "description": "<p>Letter</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "limit",
            "description": "<p>Limit</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "offset",
            "description": "<p>Offset</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Last name</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Lastname"
  },
  {
    "type": "post",
    "url": "/lastname/request",
    "title": "Request missing lastname",
    "name": "request",
    "group": "Lastname",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Lastname request</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "customer_email",
            "description": "<p>Customer email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "customer_firstname",
            "description": "<p>Customer firstname</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "customer_lastname",
            "description": "<p>Customer lastname</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Mixed",
            "optional": false,
            "field": "data",
            "description": "<p>Last name stats</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Lastname"
  },
  {
    "type": "get",
    "url": "/logo/getByCategory",
    "title": "Get logos templates by category",
    "name": "getByCategory",
    "group": "Logo",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Category ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "offset",
            "description": "<p>Offset</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>URL</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Logo"
  },
  {
    "type": "get",
    "url": "/logo/categories",
    "title": "Get logo categories",
    "name": "getDetails",
    "group": "Logo",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "limit",
            "description": "<p>Limit</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "offset",
            "description": "<p>Offset</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Category name</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "priority",
            "description": "<p>Category priority</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "count",
            "description": "<p>Number logos in category</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Logo"
  },
  {
    "type": "get",
    "url": "/logo/categories",
    "title": "Get logo categories",
    "name": "getDetails",
    "group": "Logo",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "limit",
            "description": "<p>Limit</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "offset",
            "description": "<p>Offset</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Category name</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "priority",
            "description": "<p>Category priority</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "count",
            "description": "<p>Number logos in category</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Logo"
  },
  {
    "type": "get",
    "url": "/logo/getLogoFullsize",
    "title": "Get fullsize logo for print",
    "name": "getFullsifze",
    "group": "Logo",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Logo ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>URL</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Logo"
  },
  {
    "type": "get",
    "url": "/logo/getLogoPreview",
    "title": "Get preview logo",
    "name": "getFullsiz1fe",
    "group": "Logo",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Logo template ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Last",
            "description": "<p>name Last name</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>URL</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Logo"
  },
  {
    "type": "get",
    "url": "/logo/getPopular",
    "title": "Get popular logos",
    "name": "getFullsize",
    "group": "Logo",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Logo ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>URL</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Logo"
  },
  {
    "type": "get",
    "url": "/logo/getLogosByLastname",
    "title": "Get logos for specific lastname",
    "name": "getFullsizfdsafdse",
    "group": "Logo",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lastname",
            "description": "<p>Lastname</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>URL</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Logo"
  },
  {
    "type": "get",
    "url": "/services/getCredits",
    "title": "Get credits available",
    "name": "getFullsize",
    "group": "Misc",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "count",
            "description": "<p>Count of credits available</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./example.php",
    "groupTitle": "Misc"
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./apidocs/main.js",
    "group": "_mnt_hgfs_www_sites_apitest_code_apidocs_main_js",
    "groupTitle": "_mnt_hgfs_www_sites_apitest_code_apidocs_main_js",
    "name": ""
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./doc/main.js",
    "group": "_mnt_hgfs_www_sites_apitest_code_doc_main_js",
    "groupTitle": "_mnt_hgfs_www_sites_apitest_code_doc_main_js",
    "name": ""
  }
] });
